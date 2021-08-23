<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class Index extends Component{
    public $search;
    public $sort = "id";
    public $direction = "asc";

    public $openBrand = false;
    public $showCreateProduct = false;
    public $productStatus;

    public function render(){

        $products = Product::where('name','like','%'. $this->search . '%')->orderBy($this->sort,$this->direction)->get();
        $brands= Brand::all();
        $categories= Category::all();
        $tags= Tag::all();

        return view('livewire.admin.products.index', compact('products','brands','categories','tags'));
    }
    
    public function order($sort){
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }      
    }

    public function saveName($product_id , $name){
        $product = Product::find($product_id);
        $oldName = $product->name;
        $product->name = $name; 
        $product->save();
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Se ha cambiado '$oldName' por '$name'",
            'icon' => 'success',
            'title' => "El nombre ha sido cambiado",
        ]); 
    }
    
    public function saveBrand($product_id , $brand_id){
        $product = Product::find($product_id);
        $brand = Brand::find($brand_id);
        $oldBrand = $product->brand->name;
        $product->brand_id = $brand_id; 
        $product->save();
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Se ha cambiado '$oldBrand' por '$brand->name'",
            'icon' => 'success',
            'title' => "La marca ha sido cambiada",
        ]); 
    }
    
    public function saveCategoria($product_id , $category_id){
        $product = Product::find($product_id);
        $category = Category::find($category_id);
        $oldCategory = $product->category->name;
        $product->category_id = $category_id; 
        $product->save();
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Se ha cambiado '$oldCategory' por '$category->name'",
            'icon' => 'success',
            'title' => "La marca ha sido cambiada",
        ]); 
    }

    public function saveFormato($product_id , $value){
       
        $product = Product::find($product_id);
        $oldValue = $product->formato;
        $product->formato = $value; 
        $product->save();
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Se ha cambiado '$oldValue' por '$value'",
            'icon' => 'success',
            'title' => "El formato ha sido cambiado",
        ]); 
    }

    public function removeTag($product_id , $tag_id){
        $tag = Tag::find($tag_id);
       
        $product = Product::find($product_id);
        $product->tags()->detach($tag_id);
        $product->save();

        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Se ha eliminado la etiqueta $tag->name",
            'icon' => 'success',
            'title' => "Etiqueta eliminada",
        ]); 
    }

    public function setStatus($product_id, $valor){
        $product = Product::find($product_id);
        $product->status = $valor; 
        $product->save();
       
    }

    public function setSpecialSalePrice($product_id, $valor){
        $product = Product::find($product_id);
        $product->special_sale_price = $valor; 
        $product->save();
       
    }




}

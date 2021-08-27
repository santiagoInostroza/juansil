<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\SalePrice;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;



class Index extends Component{
    
    use WithFileUploads;
    use WithPagination;

    public $search;
    public $sort = "id";
    public $direction = "desc";

    public $openBrand = false;
    public $showCreateProduct = false;
    public $openChangePhoto = false;
    public $productStatus;
    public $onlyStock = true;
    public $show=5;

    protected $listeners = ['refreshComponent' => '$refresh','closeCreateProduct'];


    public function closeCreateProduct(){
        $this->showCreateProduct = false;
    }

    public function render(){

        $query = Product::with(['salePrices','tags'])->where('name','like','%'. $this->search . '%')->orderBy($this->sort,$this->direction);
        if($this->onlyStock){
            $products= $query->where('stock','>',0);
        }
        $products = $query->paginate($this->show);

        $brands= Brand::all();
        $categories= Category::all();
        $tags= Tag::all();

        return view('livewire.admin.products.index', compact('products','brands','categories','tags'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
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
        $product->name = $name; 
        $product->slug = Str::slug($name); 
        $product->save();
    }
    
    public function saveBrand($product_id , $brand_id){
        $product = Product::find($product_id);
        $product->brand_id = $brand_id; 
        $product->save();
    }
    
    public function saveCategoria($product_id , $category_id){
        $product = Product::find($product_id);
        $oldCategory = $product->category->name;
        
        $product->category_id = $category_id; 
        $product->save();
        
        $category = Category::find($category_id);
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Se ha cambiado '$oldCategory' por '$category->name'",
            'icon' => 'success',
            'title' => "La categoría ha sido cambiada",
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


    public function setStatus($product_id, $valor){
        $product = Product::find($product_id);
        $product->status = $valor; 
        $product->save();
       
    }

    public function setStockMin($product_id, $valor){
        $product = Product::find($product_id);
        $product->stock_min = $valor; 
        $product->save();
       
    }

    public function setSpecialSalePrice($product_id, $valor){
        $product = Product::find($product_id);
        $product->special_sale_price = $valor; 
        $product->save();
       
    }
    public function setSalePrice($price_id, $quantity, $valor, $valor_por_caja){
        $price = SalePrice::find($price_id);
        $price->quantity = $quantity; 
        $price->price = $valor; 
        $price->total_price = $valor_por_caja; 
        $price->save();
       
    }

    public function createSalePrice($product_id, $quantity, $valor, $valor_por_caja){
        $price =  SalePrice::where('product_id',$product_id)->where('quantity',$quantity)->first();
        if(!$price){
            $price = new SalePrice();
            $price->product_id = $product_id; 
        }
        $price->quantity = $quantity; 
        $price->price = $valor; 
        $price->total_price = $valor_por_caja; 
        $price->save(); 
       
    }

    public function removePrice(SalePrice $price){
        $price->delete();  
    }

    public function removeTag( $product_id, $tag_id){
        $product = Product::find($product_id); 
        $product->tags()->detach($tag_id);
        $this->render();
        $product->refresh();
    }


    public function saveTag($product_id, $tag_id){
        if($tag_id>0){

            $product = Product::find($product_id);
            if( !$product->tags->contains('id',$tag_id)){
                $product->tags()->attach($tag_id);
                return true;
            }else{
                return false;
            }
           
        }else{
            return false;
        }
        
       
    }

    public function saveDescription($product_id, $description){
        $product = Product::find($product_id);
        $product->description = $description;
        $product->save();
    }

    public $photo0;
    public $product_selected;

    public function changePhoto($product_id){
        $product = Product::find($product_id);
        $this->product_selected = $product;
        $this->openChangePhoto = true;
        
    }

    public function savePhoto(){
        
        if($this->photo0){
            request()->validate([
                'photo0' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            //consigue el nombre
            $url  = $this->photo0->hashName();

            if ($this->product_selected->image) {

                // Elimina imagen existente
                Storage::delete('products/'. $this->product_selected->image->url);
                Storage::delete('products_thumb/' .  $this->product_selected->image->url);

                //guarda en products
                $this->photo0->store('products');


                 // guarda en products
                $manager =  new ImageManager();
                $image = $manager->make('storage/products/'.$url)->resize(1024, 1024, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
    
                // guarda en thumbs
                $manager =  new ImageManager();
                $image = $manager->make('storage/products/'.$url)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->save('storage/products_thumb/'.$url);

                // guarda en base de datos (ACTUALIZA)
                $this->product_selected->image->update([
                    'url' =>  $url,
                ]);
                
            } else {

                 // guarda en base de datos (CREA NUEVO)
                $this->product_selected->image()->create([
                    'url' => $url
                ]);
            }


        }

        $this->openChangePhoto = false;
        $this->photo0 = "";
    }




}

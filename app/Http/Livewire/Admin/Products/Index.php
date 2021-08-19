<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class Index extends Component{
    public $search;
    public $sort = "id";
    public $direction = "asc";

    public $openBrand = false;

    public function render(){

        $products = Product::where('name','like','%'. $this->search . '%')->orderBy($this->sort,$this->direction)->get();
        $brands= Brand::all();

        return view('livewire.admin.products.index', compact('products','brands'));
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

    public function saveBrand($product_id , $brand_id){
        $product = Product::find($product_id);
        $product->brand_id = $brand_id; 
        $product->save();
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "La marca ha sido cambiada",
            'icon' => 'success',
            'title' => "La marca ha sido cambiada",
    ]); 
    }


}

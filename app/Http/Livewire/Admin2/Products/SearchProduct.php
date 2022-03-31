<?php

namespace App\Http\Livewire\Admin2\Products;

use App\Models\Product;
use Livewire\Component;

class SearchProduct extends Component{
    public $allProducts;
    public $searchProduct;
    public $dropdownSearchProduct;
    public $favorites;
    

    public function mount(){
        $this->allProducts = null;
        $this->searchProduct = null;
        $this->dropdownSearchProduct = false;
        $this->favorites =  [
            'leche',
            'galleta',
            'bombillin',
            'andina',
            'sin lactosa',
            'yoghurt',
            'compota',
        ];
    }


    public function render(){

        return view('livewire.admin2.products.search-product');
    }


    public function updatedSearchProduct(){

        if($this->searchProduct != null){
            $strings = explode(' ', trim($this->searchProduct));
            $this->allProducts = Product::where(function ($query) use ($strings) {
                foreach ($strings as $string) {
                    $query->where('name', 'like', '%' . $string . '%');
                }
            })->get();
        }else{
            $this->allProducts = null;
        }
    }

    public function setFavorite($favorite){
        $this->searchProduct = $favorite;
        $this->updatedSearchProduct();
        $this->dropdownSearchProduct = true;

    }

    public function addTo($product_id){
        $this->emit('addToPurchase',$product_id);  
        $this->dropdownSearchProduct=false;    
    }


}


<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class Index extends Component{

    public function render(){

        $products = Product::where('stock','>',0)->where('status','=',1)->get();
        return view('livewire.products.index',compact('products'));
    }
}

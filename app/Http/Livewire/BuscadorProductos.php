<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;

class BuscadorProductos extends Component{

    public $search;
    public $busqueda = false;
    public $type_selected = 1;

    public function render(){

       
            $products = Product::where('name','like', '%'. $this->search. '%')->get();
     
            $tags = Tag::where('name','like', '%'. $this->search . '%')->get();
        


        return view('livewire.buscador-productos', compact('products','tags'));
    }
}

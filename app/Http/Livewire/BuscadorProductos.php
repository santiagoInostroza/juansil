<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;

class BuscadorProductos extends Component{

    public $search;
    public $searchIsOpen = false;
    public $type_selected = 1;
    public $cantidad = 1;


    public function render(){
        $tags = Tag::where('name','like', '%'. $this->search . '%')->get();

      
            $str = explode(' ', $this->search);

            $products = Product::where(function($query) use($str) {
                foreach($str as $s) {
                    $query = $query->where('name','like',"%" . $s . "%");
                }
            })
            ->get();

                
        


        return view('livewire.buscador-productos', compact('products','tags'));
    }
}

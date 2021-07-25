<?php

namespace App\Http\Livewire\Productos;

use App\Models\Product;
use Livewire\Component;

class Show extends Component{
    public $producto;

    public function render(){

        $misma_categoria = Product::where('category_id', $this->producto->category_id)
        ->where('id', '!=', $this->producto->id)
        ->take(4)
        ->get();

        $misma_marca = Product::where('brand_id', $this->producto->brand_id)
        ->where('id', '!=',$this->producto->id)
        ->take(4)
        ->get();

    
        return view('livewire.productos.show',compact('misma_marca', 'misma_categoria'));
    }
}

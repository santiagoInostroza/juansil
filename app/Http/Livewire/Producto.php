<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Producto extends Component{
    public $producto;
    
    public function render()
    {
        return view('livewire.producto');
    }
    
}

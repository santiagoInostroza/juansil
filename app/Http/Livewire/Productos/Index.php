<?php

namespace App\Http\Livewire\Productos;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Http\Controllers\CarritoController;

class Index extends Component{
    
    public function render(){
        $categories = Category::all();
        return view('livewire.productos.index',compact('categories'));
    }

}

<?php

namespace App\Http\Livewire\Productos;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Index extends Component{
    public function render(){
        $categories = Category::all();
        return view('livewire.productos.index',compact('categories'));
    }
}

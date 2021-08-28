<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class Navigation extends Component{

    public $texto = "";
    public $search = false;


    public function render()
    {
        $categories = Category::where('name','!=','otros')->get();
        return view('livewire.navigation', compact('categories'));
    }
}

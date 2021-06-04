<?php

namespace App\Http\Livewire\Admin\Ventas;

use Livewire\Component;

class Create extends Component{ 
    public $open = true;
    public $openAddProduct = true;
    
    public function render(){
        return view('livewire.admin.ventas.create');
    }
}

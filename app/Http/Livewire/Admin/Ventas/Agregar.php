<?php

namespace App\Http\Livewire\Admin\Ventas;

use Livewire\Component;

class Agregar extends Component{
    public $open = false;

    public function render(){
        return view('livewire.admin.ventas.agregar');
    }
}

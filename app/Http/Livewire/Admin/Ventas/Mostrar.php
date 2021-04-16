<?php

namespace App\Http\Livewire\Admin\Ventas;

use Livewire\Component;

class Mostrar extends Component{
    public $venta;
    public $open = false;
    
    public function render()
    {
        return view('livewire.admin.ventas.mostrar');
    }
}

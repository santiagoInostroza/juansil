<?php

namespace App\Http\Livewire\Admin\Ventas;

use Livewire\Component;

class Index extends Component{
    public $vista = 0;
    public $venta_id = 0;

    public function render(){
        return view('livewire.admin.ventas.index')->layout('layouts.admin');
    }
}

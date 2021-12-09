<?php

namespace App\Http\Livewire\Admin\Comunas;

use App\Models\Comuna;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $comunas = Comuna::all();
        return"hola";
        
        return view('livewire.admin.comunas.index',compact('comunas'));
    }
}

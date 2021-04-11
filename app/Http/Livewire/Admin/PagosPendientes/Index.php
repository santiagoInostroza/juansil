<?php

namespace App\Http\Livewire\Admin\PagosPendientes;

use Livewire\Component;

class Index extends Component{
    public $vista = 1;
    public $customer_id;

    public function render()
    {
        return view('livewire.admin.pagos-pendientes.index');
    }
}

<?php

namespace App\Http\Livewire\Admin\PagosPendientes;

use Livewire\Component;

class Index extends Component{
    public $vista = 0;
    public $customer_id;

    protected $listeners = ['verCliente'];

    public function render(){
        return view('livewire.admin.pagos-pendientes.index');
    }


    public function verCliente($id){
        $this->customer_id = $id;
        $this->vista = 1;
    }

}

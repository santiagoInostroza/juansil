<?php

namespace App\Http\Livewire\Admin\PagosPendientes;

use App\Models\Sale;
use Livewire\Component;

class All extends Component
{
    public $search;
    public function render()
    {
        $pendientes = Sale::join('customers', 'customer_id', '=', 'customers.id')
        ->where('customers.name', 'like', '%'. $this->search .'%')
        ->where('payment_status','!=',3)
        ->select('sales.*')
        ->get();

        return view('livewire.admin.pagos-pendientes.all',compact('pendientes'));
    }

    public function verCliente($id){
        $this->emitUp('verCliente',$id);
    }
}

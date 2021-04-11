<?php

namespace App\Http\Livewire\Admin\PagosPendientes;

use App\Models\Sale;
use Livewire\Component;
use App\Models\Customer;

class All extends Component
{
    public $search;
    public function render()
    {
        $pendientes = Customer::join('sales', 'sales.customer_id', '=', 'customers.id')
        ->where('customers.name', 'like', '%'. $this->search .'%')
        ->where('payment_status','!=',3)
        ->select('customers.*')
        ->distinct()
        ->get();

        return view('livewire.admin.pagos-pendientes.all',compact('pendientes'));
    }

    public function verCliente($id){
        $this->emitUp('verCliente',$id);
    }
}

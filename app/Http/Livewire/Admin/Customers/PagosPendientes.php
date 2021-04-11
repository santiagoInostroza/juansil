<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Customer;

class PagosPendientes extends Component
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

        return view('livewire.admin.customers.pagos-pendientes',compact('pendientes'));
    }

    public function verDetallePagosPendientes($id){
        $this->emitUp('verDetallePagosPendientes',$id);
    }
}

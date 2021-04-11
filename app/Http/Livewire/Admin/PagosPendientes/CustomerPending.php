<?php

namespace App\Http\Livewire\Admin\PagosPendientes;

use Livewire\Component;
use App\Models\Customer;

class CustomerPending extends Component{
    public $customer_id;
    public $customer;

    public function render(){
        return view('livewire.admin.pagos-pendientes.customer-pending');
    }

    public function mount(){
        if ($this->customer_id > 0) {
           $this->customer = Customer::find($this->customer_id);
        }
    }
}

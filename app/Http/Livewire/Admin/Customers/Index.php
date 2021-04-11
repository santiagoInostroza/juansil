<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class Index extends Component{

    protected $listeners = ['verDetallePagosPendientes'];
   
    public $vista = 0;
    public $customer_id = 0;

    
    public function render(){
       
        return view('livewire.admin.customers.index');
    }

    public function verDetallePagosPendientes($id)
    {
        $this->vista = 2;
        $this->customer_id = $id;
    }




}

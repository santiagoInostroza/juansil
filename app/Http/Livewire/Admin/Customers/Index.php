<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;

class Index extends Component{

    public $search;
    
    public function render(){
        $customers = Customer::where('name','like','%'. $this->search .'%')
        ->orWhere('direccion','like','%'. $this->search .'%')
        ->orWhere('block','like','%'. $this->search .'%')
        ->orWhere('depto','like','%'. $this->search .'%')
        ->orWhere('celular','like','%'. $this->search .'%')
        ->orWhere('telefono','like','%'. $this->search .'%')
        ->get();
        return view('livewire.admin.customers.index',compact('customers'));
    }




}

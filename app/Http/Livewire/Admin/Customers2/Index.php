<?php

namespace App\Http\Livewire\Admin\Customers2;

use App\Models\User;
use Livewire\Component;
use App\Models\Customer;

class Index extends Component{
    
    public function render(){
        $customers = Customer::with('sales')
        ->orderBy('comuna', 'asc')
        ->get();
        $users = User::all();
        return view('livewire.admin.customers2.index',compact('customers','users') );
    }
}

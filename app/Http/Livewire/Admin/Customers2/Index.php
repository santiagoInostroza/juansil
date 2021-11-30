<?php

namespace App\Http\Livewire\Admin\Customers2;

use App\Models\User;
use App\Models\Comuna;
use Livewire\Component;
use App\Models\Customer;

class Index extends Component{
    
    public function render(){
        $comunas = Comuna::all();
        $customers = Customer::with('sales')
        ->orderBy('comuna', 'asc')
        ->where('comuna','puente alto')
        ->get();
        $users = User::all();
        return view('livewire.admin.customers2.index',compact('customers','users','comunas') );
    }
}

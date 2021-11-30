<?php

namespace App\Http\Livewire\Admin\Customers2;

use App\Models\User;
use App\Models\Comuna;
use Livewire\Component;
use App\Models\Customer;

class Index extends Component{

    public $nombreComuna = "la granja";
    
    public function render(){
        $comunas = Comuna::where('tiene_reparto',1)->get();
        $customers = Customer::with('sales')
        ->orderBy('comuna', 'asc')
        ->where('comuna', $this->nombreComuna)
        ->get();
        $users = User::all();
        return view('livewire.admin.customers2.index',compact('customers','users','comunas') );
    }
}

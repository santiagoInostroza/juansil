<?php

namespace App\Http\Livewire\Admin\Customers2;

use App\Models\User;
use App\Models\Comuna;
use Livewire\Component;
use App\Models\Customer;

class Index extends Component{

    public $nombreComuna = "";
    public $search="";
    
    public function render(){
        $comunas = Comuna::where('tiene_reparto',1)->get();
        $customers = Customer::with('sales')
        ->orderBy('comuna', 'asc')
        ->where('comuna','like', '%'. $this->nombreComuna . '%')
        ->where( function($query){
            $query
            ->orWhere('name','like', '%'. $this->search . '%')
            ->orWhere('direccion','like', '%'. $this->search . '%');
        })
        ->get();
        $users = User::all();
        return view('livewire.admin.customers2.index',compact('customers','users','comunas') );
    }
}

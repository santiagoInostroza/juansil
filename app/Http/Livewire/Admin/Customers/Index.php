<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render(){
        $customers = Customer::where('name','like','%'. $this->search .'%')
        ->orWhere('direccion','like','%'. $this->search .'%')
        ->orWhere('block','like','%'. $this->search .'%')
        ->orWhere('depto','like','%'. $this->search .'%')
        ->orWhere('celular','like','%'. $this->search .'%')
        ->orWhere('telefono','like','%'. $this->search .'%')
        ->paginate(50);
        return view('livewire.admin.customers.index',compact('customers'));
    }




}

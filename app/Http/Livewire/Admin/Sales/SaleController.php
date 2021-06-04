<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Sale;
use Livewire\Component;

class SaleController extends Component{

    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $open_show;
    public $selected_sale;

    protected $listeners = ['render'];

    public function render(){
       
        $sales =  Sale::join('customers','sales.customer_id','=','customers.id')
        ->where('sales.id','like','%'. $this->search . '%')
        ->orWhere('customers.name','like','%'. $this->search . '%')
        ->orWhere('customers.direccion','like','%'. $this->search . '%')
        ->orWhere('customers.block','like','%'. $this->search . '%')
        ->orWhere('customers.depto','like','%'. $this->search . '%')
        ->orWhere('customers.celular','like','%'. $this->search . '%')
        ->orWhere('sales.total','like','%'. $this->search . '%')
        ->orWhere('sales.date','like','%'. $this->search . '%')
        
        ->select('sales.*')
        ->orderBy($this->sort,$this->direction)
        ->paginate(50);
        return view('livewire.admin.sales.sale-controller',compact('sales'))->layout('layouts.admin');
    }


    public function order($sort){
        if ($this->sort == $sort) {
           
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
            
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        
      
    }

    public function open_show(Sale $sale){
        $this->open_show = true;
        $this->selected_sale = $sale;

        
    }
}

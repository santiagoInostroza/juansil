<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Models\Sale;
use Livewire\Component;


class Report extends Component{
    public $date;

    protected $listeners = ['render'];

    public function render(){
        $orders = Sale::where('delivery','1')->whereDate('delivery_date', $this->date)->get(); 

        $sales = Sale::where('delivery','1')->whereDate('delivery_date', $this->date)->where('payment_status',3)->where('delivery_stage',1)->get(); 
        
        $sales = $sales->concat(Sale::where('delivery','1')
        ->whereDate('delivery_date', $this->date)
        ->where(function($query){
            $query
            ->orWhere('payment_status','!=',3)
            ->orWhere('delivery_stage',0)
            ->orWhere('delivery_stage',null);
        })->get());

        return view('livewire.admin.deliveries.report',compact('orders','sales'));
    }
}

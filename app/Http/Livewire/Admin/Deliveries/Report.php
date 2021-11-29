<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Models\Sale;
use Livewire\Component;


class Report extends Component{
    public $date;
    
    public function render(){
        $orders = Sale::where('delivery','1')->whereDate('delivery_date', $this->date)->get(); 
        return view('livewire.admin.deliveries.report',compact('orders'));
    }
}

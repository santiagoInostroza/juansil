<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Sale;
use Livewire\Component;

class TodayOrders extends Component
{
    public function render(){
        $sales = Sale::take(10)->get();
        return view('livewire.admin.sales.today-orders',compact('sales'));
    }
}

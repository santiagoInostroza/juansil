<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Models\Sale;
use Livewire\Component;

class DeliveriesNotification extends Component{

    public $isOpenNotification = false;

    public function render(){
        $sales = Sale::where('delivery',1)->get();
        return view('livewire.admin.deliveries.deliveries-notification',compact('sales'));
    }

    public function openNotification(){
        $this->isOpenNotification = true;
    }
}

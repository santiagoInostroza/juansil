<?php

namespace App\Http\Livewire\Admin\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class DeliveriesNotification extends Component{

    public $isOpenNotification = false;

    public function render(){
        $pendings = Sale::where('delivery',1)->whereDate('delivery_date',Carbon::today()->toDateString())->where('delivery_stage',1)->get();
        $delivereds = Sale::where('delivery',1)->whereDate('delivery_date',Carbon::today()->toDateString())->where('delivery_stage',2)->get();
        return view('livewire.admin.deliveries.deliveries-notification',compact('pendings','delivereds'));
    }

    public function openNotification(){
        $this->isOpenNotification = true;
    }
}

<?php

namespace App\Http\Livewire\Admin\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use App\Http\Controllers\Admin\DeliveryController;

class Index extends Component{

    public $showAgregarDespacho = false;
    public $date;


    protected $listeners = ['closeAgregarProducto','payOrder','deliverOrder','saveDriverComment'];



    public function render(){
        
        $orders = Sale::where('delivery','1')->whereDate('delivery_date', $this->date)->get(); 
        
        $porcDelivery="";
        $porcPayment="";
        if ($orders->count()>0) {
            $porcDelivery = round( $orders->where('delivery_stage',1)->count() / $orders->count()* 100);
            $porcPayment = round( $orders->where('payment_status',3)->count() / $orders->count()* 100);
        }

       


      
        return view('livewire.admin.deliveries.index',compact('orders','porcDelivery','porcPayment'));
    }
    
    public function closeAgregarProducto(){
        $this->showAgregarDespacho = false;
    }

    public function payOrder(Sale $sale, $account = 1){
        $deliveryController= new DeliveryController();
        $deliveryController->payOrder($sale, $account);
        $this->dispatchBrowserEvent('name-updated', 
        [
            'id' => $sale->id,
            'delivery_stage' => $sale->delivery_stage,
            'payment_status' => $sale->payment_status,
        ]);
        $this->emit('render');
      }

      public function deliverOrder(Sale $sale){
        $deliveryController= new DeliveryController();
        $deliveryController->deliverOrder($sale);
        $this->emit('render');
        $this->dispatchBrowserEvent('name-updated', 
        [
            'id' => $sale->id,
            'delivery_stage' => $sale->delivery_stage,
            'payment_status' => $sale->payment_status,
        ]);
    }
    public function saveDriverComment(Sale $sale, $comment ){

       $sale->driver_comment =($sale->driver_comment==null)
        ? $comment .'<br>'. auth()->user()->name . ' ' . date('d-m-Y H:i:s').'<br>'
        :  $comment.'<br>'. auth()->user()->name . ' ' . date('d-m-Y H:i:s').'<br><br>'.  $sale->driver_comment ;       
       $sale->save();
       $this->emit('render');
    }




}

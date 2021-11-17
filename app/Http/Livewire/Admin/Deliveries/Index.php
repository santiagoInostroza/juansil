<?php

namespace App\Http\Livewire\Admin\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use App\Http\Controllers\Admin\DeliveryController;

class Index extends Component{

    public $showAgregarDespacho = false;
    public $date;


    protected $listeners = ['closeAgregarProducto','payOrder','deliverOrder'];



    public function render(){
        $orders = Sale::where('delivery','1')->whereDate('delivery_date', $this->date)->get();    
      
        return view('livewire.admin.deliveries.index',compact('orders'));
    }
    
    public function closeAgregarProducto(){
        $this->showAgregarDespacho = false;
    }

    public function payOrder(Sale $sale){
        $deliveryController= new DeliveryController();
        $deliveryController->payOrder($sale);
        $this->emit('render');
        $this->dispatchBrowserEvent('name-updated', ['id' => $sale->id]);
      }

      public function deliverOrder(Sale $sale){
        $deliveryController= new DeliveryController();
        $deliveryController->deliverOrder($sale);
        $this->emit('render');
        $this->dispatchBrowserEvent('name-updated', ['id' => $sale->id]);
    }




}

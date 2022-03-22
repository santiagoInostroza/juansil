<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Http\Controllers\Admin\DeliveryController;
use App\Models\Sale;
use Livewire\Component;

class OrderInfo extends Component{

    public $mostrar_venta=false;
    public $venta;


    protected $listeners = ['mostrar_venta','render'];

    public function render(){

        return view('livewire.admin.deliveries.order-info');
    }
    
    public function mostrar_venta($id){
        $this->mostrar_venta=true;
        $this->venta= Sale::find($id);

    }

    public function payOrder(Sale $sale, $account){
      $this->emit('payOrder',$sale,$account);
    }

    public function deliverOrder(Sale $sale){
        $this->emit('deliverOrder',$sale);
    }
    public function saveDriverComment(Sale $sale,$comment){
        $this->emit('saveDriverComment',$sale,$comment);
    }
}

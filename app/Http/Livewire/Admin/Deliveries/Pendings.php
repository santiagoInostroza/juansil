<?php

namespace App\Http\Livewire\Admin\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use App\Http\Controllers\Admin\DeliveryController;

class Pendings extends Component{

    public $fecha;

    protected $listeners = ['pagar','entregar','render'];

    public function render(){
        $ventas = Sale::where('delivery','1') ->whereDate('delivery_date', $this->fecha)
         ->where(function($query){
             $query->orWhere('payment_status','!=','3')->orWhere('delivery_stage',null);
         })  
        ->get();

        return view('livewire.admin.deliveries.pendings',["ventas" =>  $ventas,'entregas_pendientes' => count($ventas) ]);
    }

    public function payOrder(Sale $sale,$account){
        $this->emit('payOrder',$sale,$account);
      }
  
      public function deliverOrder(Sale $sale){
          $this->emit('deliverOrder',$sale);
      }

    public function actualizar($id){
        $this->emit('actualizarEntregados',$id);
        $this->emit('mostrar_venta',$id);
    }

}

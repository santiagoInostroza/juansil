<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Sale;
use Livewire\Component;
use App\Http\Controllers\Admin\SaleController;

class TodayOrders extends Component{
    public $orderEdit;

    public $delivery;
    public $valor_despacho ;
    public $estado_pago;
    public $openComentario ;

    public function mount(){
      
    }

    public function render(){
        $sales = Sale::orderBy('id','desc')->take(50)->get();
        return view('livewire.admin.sales.today-orders',compact('sales'));
    }

    public function selectedOrderEdit($id){
       $this->orderEdit=Sale::find($id);
    }

    public function modificateOrder(){
       
    }

    public function deleteSale(Sale $sale){
        $saleController = new SaleController();
        $saleController->deleteSale($sale);
        $this->dispatchBrowserEvent('alerta', [
                'msj' =>  "Pedido " . $sale->id ." eliminado !!. Total ". number_format($sale->total,0,',','.'),
                'icon' => 'success',
                'title' => "Pedido Eliminado",
        ]); 
    }


}

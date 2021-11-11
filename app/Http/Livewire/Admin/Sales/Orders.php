<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Sale;
use Livewire\Component;
use App\Http\Controllers\Admin\SaleController;

class Orders extends Component{ 
    public $orderEdit;

    public $delivery;
    public $valor_despacho ;
    public $estado_pago;
    public $openComentario ;
    public $editSale = false;

    protected $listeners=[
        'render'
    ];

    public function mount(){
       
    }
    
    public function render(){
        $sales = Sale::orderBy('id','desc')->take(200)->get();
        if (!$this->editSale) {
            foreach ($sales as $key => $sale) {
                $this->editSale[$sale->id]=false;
             }
        }

        return view('livewire.admin.sales.orders',compact('sales'));
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
     public function changeDeliveryDate($id,$delivery_date){
         $sale= Sale::find($id);
         $sale->delivery_date=$delivery_date;
         $sale->save();       
     }

     public function editComment($id,$comment){
         $sale= Sale::find($id);
         $sale->comments=$comment;
         $sale->save();       
     }

    

    public function setOrderEdit($sale_id){
        
        $this->editSale[$sale_id]=true;
    }

    public function setOrderEditFalse($sale_id){
        
        $this->editSale[$sale_id]=false;
    }
}

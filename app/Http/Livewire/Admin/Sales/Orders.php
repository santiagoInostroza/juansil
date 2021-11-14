<?php

namespace App\Http\Livewire\Admin\Sales;

use Carbon\Carbon;
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
    public $filter=1;
    public $search;

    protected $listeners=[
        'renderizar'
    ];

    public function renderizar(){
        $this->editSale=false;
        $this->render();
    }
  
    public function mount(){
       
    }

    public function updatedFilter(){
        $this->editSale=false;
    }
    public function updatedSearch(){
        $this->editSale=false;
    }
    
    public function render(){

        $dt=Carbon::now();
        $sales = Sale::join('customers','customers.id','=','sales.customer_id')->where('customers.name','like','%'. $this->search . '%')->orderBy('sales.id','desc');
        if ($this->filter==1) {
            $sales = $sales->whereDate('sales.created_at',$dt);
        }elseif ($this->filter==2) {
            $sales = $sales->whereDate('sales.created_at','>=',$dt->subDays(3));
        }elseif ($this->filter==3) {
            $sales = $sales->whereDate('sales.created_at','>=',$dt->subDays(7));
        }elseif ($this->filter==4) {
            $sales = $sales->whereDate('sales.created_at','>=',$dt->subDays(30));
        }else{
           $sales = $sales->take(30);
        }

        $sales = $sales->get();

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

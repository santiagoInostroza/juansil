<?php

namespace App\Http\Livewire\Admin\Sales;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use App\Models\Purchase;
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
        $sales = Sale::join('customers','customers.id','=','sales.customer_id')->with('saleItems')->where('customers.name','like','%'. $this->search . '%');
        if ($this->filter==1) {
            $sales = $sales->whereDate('sales.created_at',$dt);
        }elseif ($this->filter==2) {
            $sales = $sales->whereDate('sales.created_at','>=',$dt->subDays(3));
        }elseif ($this->filter==3) {
            $sales = $sales->whereDate('sales.created_at','>=',$dt->subDays(7));
        }elseif ($this->filter==4) {
            $sales = $sales->whereDate('sales.created_at','>=',$dt->subDays(30));
        }elseif ($this->filter==5) {
            $sales = $sales->where('payment_status','3')->whereMonth('sales.payment_date','=', 11);
        }
        else{
           $sales = $sales->take(30);
        }

        $sales = $sales->select('sales.*')->orderBy('sales.id','desc')->get();

        if (!$this->editSale) {
            foreach ($sales as $key => $sale) {
                $this->editSale[$sale->id]=false;
            }
        }
        $purchases= Purchase::whereMonth('fecha',11)->get();

        return view('livewire.admin.sales.orders',compact('sales','purchases'));
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

    public function generateTicket(Sale $sale){

        $sale->boleta = 1;
        $sale->user_boleta = auth()->user()->id;
        $sale->fecha_boleta = Carbon::now();
        $sale->save();
        
    }
}

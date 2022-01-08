<?php

namespace App\Http\Livewire\Admin\Sales;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\SaleController;

class EditOrder extends Component{
    public $search;
    public $view = 2;

    public $delivery=false;
    public $delivered;
    public $fecha_entrega;
    public $valor_despacho;
    public $items;
    public $estado_pago=1;
    public $openComentario=false;
    public $comentario;
    public $name;

    // public $customerId;
    
    public $orderSelected;
    public $sale;



    protected $listeners=[
        'render',
    ];
    protected $messages = [
        'cantidad.required' => 'Ingresar cantidad.',
        'cantidad.numeric' => 'Ingresar valor numerico.',
        'cantidad.min' => 'Revisar.',
        'cantidad.not_in' => 'Ingresar cantidad valida.',

        'cantidad_por_caja.required' => 'Ingresar cantidad por caja.',
        'cantidad_por_caja.numeric' => 'Ingresar valor numerico.',
        'cantidad_por_caja.min' => 'Revisar.',
        'cantidad_por_caja.not_in' => 'Ingresar cantidad valida.',
       
        'precio.required' => 'Ingresar precio.',
        'precio.numeric' => 'Ingresar valor numerico.',
        'precio.min' => 'Revisar.',
        'precio.not_in' => 'Ingresar cantidad valida.',

        'precio_por_caja.required' => 'Ingresar precio por caja.',
        'precio_por_caja.numeric' => 'Ingresar valor numerico.',
        'precio_por_caja.min' => 'Revisar.',
        'precio_por_caja.not_in' => 'Ingresar cantidad valida.',



        'valor_despacho.required' => 'Ingresa valor.',
        'valor_despacho.numeric' => 'Ingresa valor numerico.',
        'fecha_entrega.required' => 'Ingresa fecha de entrega.',
        'fecha_entrega.date' => 'Ingresa formato fecha.',
        
    ];

    public function rules(){  
        if($this->delivery){
            return[
                
                'items' => 'required',
                'valor_despacho' => 'required|numeric|min:0',
                'fecha_entrega' => 'required|date',
            ];
        }else{
            return[
            
                'items' => 'required',
            ];
        }
        
    }

    public function mount(Sale $sale){
        $this->sale = $sale;
        $sale_controller= new SaleController();
        $sale_controller->loadEditSale($sale);

        $this->delivery = $sale->delivery;
        $this->delivered = $sale->delivered;
        $this->fecha_entrega = $sale->delivery_date;
        $this->valor_despacho = $sale->delivery_value;
        $this->estado_pago = $sale->payment_status;
        $this->openComentario = ($sale->comments != null)?true:false;
        $this->comentario = $sale->comments ;
        $this->name = $sale->customer->name ;
    
    }

    public function render(){

        if (session()->has('editOrder.items')) {
            $this->items = session('editOrder.items');
        }

        $products = Product::where('name' , 'like' ,  '%' . $this->search . '%' )->get();

        return view('livewire.admin.sales.edit-order',compact('products'));
    }

    public function addToTemporalOrder($id, $quantity, $price){
        $saleController = new SaleController();
        if($saleController->addToTemporalEditOrder($id, $quantity, $price) == 1){
            $this->dispatchBrowserEvent('toast', [
                'icon' => 'info',
                'title' => "Ya está en lista",
            ]);
    
        }else{
            $this->dispatchBrowserEvent('toast', [
                'icon' => 'success',
                'title' => "Agregado",
            ]); 
           $this->emitTo('admin.sales.edit-order', 'render');

        }
       
    }

    public function setQuantity($itemId,$quantity){
        $data=[
            'itemId'=> $itemId,
            'quantity'=>$quantity,
        ];
        $saleController= new SaleController();
        $response = $saleController->setTemporalEditOrder($data);

        if($response == "sinStock"){
            $this->dispatchBrowserEvent('alerta', [
                'icon' => 'error',
                'title' => "No hay suficiente stock" ,
            ]); 
            return session('editOrder.items.' . $itemId . '.cantidad' );
           
        }
        return"ok";

        

    }

    public function setQuantityBox($itemId,$quantityBox){
        $data=[
            'itemId'=>$itemId,
            'quantityBox'=>$quantityBox,
        ];
        $saleController= new SaleController();
        $response = $saleController->setTemporalEditOrder($data);

        if($response == "sinStock"){
            $this->dispatchBrowserEvent('alerta', [
                'icon' => 'error',
                'title' => "No hay suficiente stock" ,
            ]); 
            return session('editOrder.items.' . $itemId . '.cantidad_por_caja' );
           
        }
        return"ok";
    }

    public function removeFromTemporalOrder($itemId){
        $saleController= new SaleController();
        $saleController->removeFromTemporalEditOrder($itemId);
        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => "Eliminado",
        ]); 
    }

    public function alertStock($quantity){
        $this->dispatchBrowserEvent('alerta', [
            'icon' => 'error',
            'title' => "No hay suficiente stock" ,
        ]); 
    }

    public function editOrder(){
        $this->validate();
        

        $total =($this->valor_despacho>0)? $this->valor_despacho + session('editOrder.subtotal'): session('editOrder.subtotal');
        $subtotal =  session('editOrder.subtotal');

        $payment_amount = 0;
        $pending_amount = 0;
        if($this->estado_pago == 1){
            $payment_amount=0;
            $pending_amount = $total;
        }else if($this->estado_pago == 2){
            $payment_amount = $this->abono;
            $pending_amount = $total - $this->abono;
        }else if($this->estado_pago == 3){
            $payment_amount=$total;
            $pending_amount = 0;
        }

        $payment_date =($this->estado_pago == 3)? Carbon::now()->toDateString(): null;
        $delivery_date = ($this->delivery)? $this->fecha_entrega: null;
        $date_delivered = ($this->delivered)? Carbon::now()->timezone('America/Santiago') : null ;
        $delivered_user=($this->delivered)? Auth::user()->id:null;
        $delivery_value=($this->delivery)? $this->valor_despacho: null;


        $arrayVenta['sale']=[
            'customer_id' => $this->sale->customer->id,
            'total' => $total,
            'date' => Carbon::now(),
            'payment_amount' => $payment_amount,
            'payment_status' => $this->estado_pago,
            'pending_amount' => $pending_amount,
            'payment_date' => $payment_date,
            'delivery' =>  $this->delivery,
            'delivery_date' => $delivery_date,
            'date_delivered' => $date_delivered,
            'delivery_stage' => $this->delivered,
            'comments' =>  $this->comentario,
            'user_created' => Auth::user()->id,
            'delivered_user' => $delivered_user,
            'delivery_value' =>  $delivery_value,
            'subtotal' => $subtotal,
            'sale_type' => 1,
        ];
       

        foreach (session('editOrder.items') as $item) {
            $arrayVenta['items'][]=[
               'product_id' => $item['product_id'],
               'cantidad' => $item['cantidad'],
               'cantidad_por_caja' => $item['cantidad_por_caja'],
               'cantidad_total' => $item['cantidad_total'],
               'precio' => $item['precio'],
               'precio_por_caja' =>$item['precio_por_caja'],
               'precio_total' =>$item['precio_total'],
            ];
        }

        $saleController = new SaleController();
        $sale =  $saleController->editSale($this->sale,$arrayVenta);


      
        $this->emit('render');
        $this->emit('renderizar');
        $this->emit('resetear');
       
        $this->reset();
        // $this->dispatchBrowserEvent('alerta', [
        //     'msj' => "Venta a " . $sale->customer->name . " Total ". number_format($sale->total,0,',','.'),
        //     'icon' => 'success',
        //     'title' => "Venta " . $sale->id ." creada !!",
        // ]); 
        return true;
    }



  
}

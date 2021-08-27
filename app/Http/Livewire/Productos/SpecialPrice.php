<?php

namespace App\Http\Livewire\Productos;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\Admin\SaleController;

class SpecialPrice extends Component{

    public $search;

    public $showCart = false;

    public $onlyStock= true;

    protected $listeners = (['render','setCantidad','addToCart','removeFromCart','buscar']);

    public function render(){

        $query = Product::where('name','like','%' . $this->search . '%');

        if($this->onlyStock){
            $products = $query->where('stock','>', 0);
        }
        $products = $query->get();

        return view('livewire.productos.special-price',compact('products'));
    }

    public function addToCart($product_id){
        $carritoController = new CarritoController();
        $carritoController->addToCartSpecial($product_id, 1);
    }

    public function setCantidad($product_id,$cantidad){
        $carritoController = new CarritoController();
        $carritoController->setCantidadSpecial($product_id,$cantidad);
        // $this->emitTo('cart.index','render');
   }

    public function removeFromCart($product_id){
        $carritoController = new CarritoController();
        $carritoController->deleteFromCartSpecial($product_id);
        $this->emitTo('cart.index','render');
        $this->dispatchBrowserEvent('alerta_timer', [
            'icon' => 'success',
            'msj' => "Eliminado del carrito",
        ]); 
    }

    public function save(){

        // CREAR VENTA

        $customer_id= Customer::where('user_id', Auth::user()->id)->first() ;

        $arrayVenta['sale']=[
            'customer_id' => ($customer_id)? $customer_id->id : "" ,
            'total' => session('totalCarritoSpecial'),
            'date' => Carbon::now(),
            'payment_amount' => 0,
            'payment_status' => 1,
            'pending_amount' =>  session('totalCarritoSpecial'),
            'payment_date' => null,
            'delivery' => 0,
            'delivery_date' => null,
            'date_delivered' => null,
            'delivery_stage' => null,
            'comments' => '',
            'user_created' => Auth::user()->id,//
            'delivery_value' => null,
            'delivered_user' => null,
            'subtotal' => session('totalCarritoSpecial'),
            'sale_type' => 3,
        ];
       

        foreach (session('carritoSpecial') as $item) {
            $arrayVenta['items'][]=[
               'product_id' => $item['producto_id'],
               'cantidad' => $item['cantidad'],
               'cantidad_por_caja' => 1,
               'cantidad_total' => $item['cantidad'],
               'precio' => $item['precio'],
               'precio_por_caja' => $item['precio'],
               'precio_total' => $item['total'],
            ];
        }

        $sale = new SaleController();
        $sale->createSale($arrayVenta);

        session()->forget('carritoSpecial');
        session()->forget('totalCarritoSpecial');
        session()->forget('totalProductosSpecial');
        // $this->emitTo('cart.index','render');
        $this->dispatchBrowserEvent('alerta', [
            'icon' => 'success',
            'title' => "Pedido agendado!!",
            'msj' => "Apartaremos tu pedido, te esperamos...",
        ]); 

        $this->showCart = false;


        
    }

}

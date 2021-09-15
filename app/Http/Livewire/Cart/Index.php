<?php

namespace App\Http\Livewire\Cart;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarritoController;

class Index extends Component{
    public $openCarrito = false;


    protected $listeners = (['addToCart', 'removeFromCart','openCarrito','render','setCantidad']);

  


    public function render(){
        if (Auth::user() && Auth::user()->id == 6) {
            // session()->forget('carritoSpecial');
            // $this->dispatchBrowserEvent('alerta_timer', [
            //     'icon' => 'warning',
            //     'msj' => "Se borro productos del carrito",
            // ]);


        }

       

        return view('livewire.cart.index');
    }

    public function setCantidad($product_id,$cantidad){
        $carrito = new CarritoController();
        $carrito->setCantidad($product_id,$cantidad);
       
   }

   public function removeFromCart($product_id){
        $carrito = new CarritoController();
        $carrito->deleteFromCart($product_id);
        $this->emitTo('productos.lista','render');
        $this->emitTo('productos.show','render');
        $this->emitTo('productos.category','render');
        $this->emitTo('productos.tag-livewire','render');
        $this->dispatchBrowserEvent('alerta_timer', [
            'icon' => 'success',
            'msj' => "Eliminado del carrito",
        ]); 
        $this->dispatchBrowserEvent('jsShowAgregar',[
            'pid' =>$product_id,
        ]);
    }

    public function openCarrito(){
        $this->openCarrito = true;
    }

}

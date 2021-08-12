<?php

namespace App\Http\Livewire\Productos;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Http\Controllers\CarritoController;

class Index extends Component{

    protected $listeners = (['render','setCantidad','addToCart','removeFromCart','buscar']);
    
    public function render(){
        // session()->forget('carrito');
        $categories = Category::all();
        return view('livewire.productos.index',compact('categories'));
    }


    public function setCantidad($product_id,$cantidad){
        $carrito = new CarritoController();
        $carrito->setCantidad($product_id,$cantidad);
        $this->emitTo('cart.index','render');
   }

   public function addToCart($product_id){
       $carrito = new CarritoController();
       $carrito->addToCart($product_id,1);
       $this->emitTo('cart.index','render');
        $this->dispatchBrowserEvent('alerta_timer', [
           'icon' => 'success',
           'msj' => "Agregado al carrito",
       ]); 
      

   }
   public function removeFromCart($product_id){
       $carrito = new CarritoController();
       $carrito->deleteFromCart($product_id);
       $this->emitTo('cart.index','render');
       $this->dispatchBrowserEvent('alerta_timer', [
        'icon' => 'success',
        'msj' => "Eliminado del carrito",
    ]); 
   }


}

<?php

namespace App\Http\Livewire\Productos;

use App\Http\Controllers\CarritoController;
use App\Models\Product;
use Livewire\Component;

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
        
    }

}

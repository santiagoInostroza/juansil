<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CarritoController;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;

class BuscadorProductos extends Component{

    public $search;
    public $searchIsOpen = false;
    public $type_selected = 1;
    public $cantidad = 1;
    protected $listeners = (['render','setCantidad']);



    public function render(){

            // session()->pull('carrito');
            $str = explode(' ', $this->search);

            $products = Product::where(function($query) use($str) {
                foreach($str as $s) {
                    $query = $query->where('name','like',"%" . $s . "%");
                }
            })
            ->get();

            $tags = Tag::where(function($query) use($str) {
                foreach($str as $s) {
                    $query = $query->where('name','like',"%" . $s . "%");
                }
            })
            ->get();
        


        return view('livewire.buscador-productos', compact('products','tags'));
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
        $this->emitTo('productos.lista','render');
        $this->dispatchBrowserEvent('alerta_timer', [
            'icon' => 'success',
            'msj' => "Agregado al carrito",
        ]); 
       

    }
    public function removeFromCart($product_id){
        $carrito = new CarritoController();
        $carrito->deleteFromCart($product_id);
        $this->emitTo('cart.index','render');
        $this->emitTo('productos.lista','render');
        $this->dispatchBrowserEvent('alerta_timer', [
            'icon' => 'success',
            'msj' => "Eliminado del carrito",
        ]); 
    }


}

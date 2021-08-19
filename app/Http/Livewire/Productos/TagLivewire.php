<?php

namespace App\Http\Livewire\Productos;

use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Http\Controllers\CarritoController;

class TagLivewire extends Component{

    public $tag;
    protected $listeners = (['render','setCantidad','addToCart','removeFromCart2','buscar']);


    public function render(){
        $products = Product::join('product_tag','products.id','=','product_tag.product_id')
        ->where('product_tag.tag_id', $this->tag->id)
        ->select('products.*')
        ->get();

        $tags = Tag::with('products')->where('id', '!=', $this->tag->id )->get();


        return view('livewire.productos.tag-livewire', compact('products','tags'));
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
  
    public function removeFromCart2($product_id){
        $carrito = new CarritoController();
        $carrito->deleteFromCart($product_id);
        $this->emitTo('cart.index','render');
        $this->dispatchBrowserEvent('alerta_timer', [
            'icon' => 'success',
            'msj' => "Eliminado del carrito !!",
        ]); 
        $this->render();
    }

}

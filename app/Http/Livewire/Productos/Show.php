<?php

namespace App\Http\Livewire\Productos;

use App\Models\Product;
use Livewire\Component;
use App\Http\Controllers\CarritoController;
use App\Models\Tag;

class Show extends Component{
    public $producto;
    protected $listeners = (['render','setCantidad','removeFromCart','addToCart']);

    public $tag;
    public function render(){

        $misma_categoria = Product::where('category_id', $this->producto->category_id)
        ->where('id', '!=', $this->producto->id)
        ->take(12)
        ->get();

        $misma_marca = Product::where('brand_id', $this->producto->brand_id)
        ->where('id', '!=',$this->producto->id)
        ->take(12)
        ->get();

 


   
       foreach ($this->producto->tags as $tag) {
            $this->tag=$tag;

            $mismas_etiquetas[$this->tag->name] =Product::join('product_tag','product_tag.product_id','=','products.id')
            ->where('products.id', '!=',$this->producto->id)
            ->where('product_tag.tag_id', '=',$tag->id)
            ->select('products.*')
            ->take(12)->get();
        }
    
        return view('livewire.productos.show',compact('misma_marca', 'misma_categoria','mismas_etiquetas'));
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

        public function setCantidad($product_id,$cantidad){
            $carrito = new CarritoController();
            $carrito->setCantidad($product_id,$cantidad);
            $this->emitTo('cart.index','render');
           
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

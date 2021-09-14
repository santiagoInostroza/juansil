<?php

namespace App\Http\Livewire\Productos;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Http\Controllers\CarritoController;

class CategoryLivewire extends Component{
    public $category;
    protected $listeners = (['render','setCantidad','addToCart','removeFromCart2','buscar']);

    public function render(){

        $products = Product::where('category_id',$this->category->id)->where('stock','>',0)->get();
        $categories = Category::with(['products'=>function($query){
             $query->where('stock','>',0); 
            }])->where('id', '!=', $this->category->id )->where('id', '!=' , 3)->get();

        return view('livewire.productos.category-livewire',compact('products', 'categories'));
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

    public function filtro($name){
         $productos = Product::where('status', 1)->where('name', 'like',"%". $name . "%")->paginate(60);
         $destacados = Product::where('status', 1)->take(12)->get();

         return view('products.index', compact('productos','destacados','name'));
    }
}

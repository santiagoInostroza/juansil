<?php

namespace App\Http\Livewire\Productos;

use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\CarritoController;

class Lista extends Component{
    private $productos;
    private $destacados;
    protected $listeners = (['render','setCantidad']);

    public function render()
    {
        $productos = Product::where('status','1')->where('name','!=','despacho')->orderBy('name','asc')->get();
        return view('livewire.productos.lista', compact('productos'));
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
   }

    
    // public function render(){

    //     $this->getCache();
    //     $productos = $this->productos;
    //     $destacados = $this->destacados;

    //     return view('livewire.productos.lista', compact('productos','destacados'));
    // }
    // public function getCache(){
    //     $seconds = 60;

    //     if (request()->page) {
    //        $key = 'productos'. request()->page;
    //     } else {
    //         $key = 'productos';
    //     }

    //     $this->productos = Cache::remember($key, $seconds, function () {
    //         return Product::where('status', 1)->paginate(60);
    //     });

    //     $this->destacados = Cache::remember('destacados', $seconds, function () {
    //         return Product::where('status', 1)->take(12)->get();
    //     });
           
    // }
    // public function deleteCache(){
    //     $value = Cache::pull('key');
    //     $value = Cache::pull('destacados');
    // }

    public function filtro($name){
         $productos = Product::where('status', 1)->where('name', 'like',"%". $name . "%")->paginate(60);
         $destacados = Product::where('status', 1)->take(12)->get();

         return view('products.index', compact('productos','destacados','name'));
    }


    
    public function category(Category $category){
        $data=$category;
        $products = Product::where('category_id',$category->id)
        ->where('status',1)
        ->latest('id')
        ->paginate(6);

       return view('products.products',compact('products','data'));
    }

    public function tag(Tag $tag){
        $data=$tag;
        $products = $tag->products()->where('status',1)->latest('id')->paginate(4);
        return view('products.products',compact('products','data'));
    }

}

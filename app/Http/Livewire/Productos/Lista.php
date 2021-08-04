<?php

namespace App\Http\Livewire\Productos;

use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\CarritoController;
use App\Models\Brand;

class Lista extends Component{
    private $productos;
    private $destacados;
    public $search;
    protected $listeners = (['render','setCantidad','addToCart','removeFromCart','buscar']);

    public function render(){


        $str = explode(' ', $this->search);

        $productos = Product::where('products.status','1')->where('products.name','!=','despacho')->where(function($query) use($str) {
            foreach($str as $s) {
                $query = $query->where('products.name','like',"%" . $s . "%");
            }
        })
        ->orderBy('name','asc')->get();

        $tags = Tag::where(function($query) use($str) {
            foreach($str as $s) {
                $query = $query->where('name','like',"%" . $s . "%");
            }
        })
        ->orderBy('name','asc')->get();
        
        $brands = Brand::where(function($query) use($str) {
            foreach($str as $s) {
                $query = $query->where('name','like',"%" . $s . "%");
            }
        })
        ->orderBy('name','asc')->get();



        // $productos = Product::where('status','1')->where('name','!=','despacho')->where('name','like','%'. $this->search . "%")->orderBy('name','asc')->get();
        return view('livewire.productos.lista', compact('productos','tags','brands'));
    }

    public function buscar($search){
        $this->search = $search;

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

<?php

namespace App\Http\Livewire\Productos;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\MovementSale;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CarritoController;
use App\Models\Tag;

class Index extends Component{

    public $onlyStock = true;

    protected $listeners = (['render','setCantidad','addToCart','removeFromCart2','buscar']);
    
    public function render(){
        // session()->forget('carrito');
      


        $categories = Category::with(['products.salePrices','products.tags','products.brand','products.image','products' => function($query) {
           $query->where('status',1)->where('stock','>',0);
        }])
        ->where('id','!=', 3)->get();
        // ->where('id','!=', 3)->get()->map(function($query) { $query->setRelation('products', $query->products->take(12)); return $query; });



        // $ultimasCompras = Purchase::with(['purchase_items','purchase_items.product.brand','purchase_items.product.image','purchase_items.product.category','purchase_items.product'
        //  => function($query){  $query->where('status',1); }
        //  ,'purchase_items.product.salePrices'])
        // ->orderBy('fecha','desc')->take(8)->get();

      
        // $tentaciones =Tag::where('name','Tentaciones')->with(['products'=> function($query){
        //     $query->where('stock','>',0)->where('status','=',1);
        // },'products.brand','products.tags','products.category','products.image'])->first();




        // $idLoMasVendido = MovementSale::select(DB::raw('sum(cantidad) as cantidad, product_id'))
        // ->groupBy('product_id')
        // ->orderBy('cantidad', 'desc')
        // ->take('10')
        // ->get();

        // $loMasVendido = collect();
        // foreach ($idLoMasVendido as $value) {
        //     $item = Product::with('salePrices','brand','image')->where('id',$value->product_id)->where('status',1) ;
          
        //     $loMasVendido->push(collect( $item->get()));
          
        // }

        return view('livewire.productos.index',compact('categories'));
        // return view('livewire.productos.index',compact('categories','ultimasCompras','loMasVendido','tentaciones'));
    }

    public function restaurarSesion(){
        session()->forget('carrito');
    }


    public function setCantidad($product_id,$cantidad){
        $carrito = new CarritoController();
        $carrito->setCantidad($product_id,$cantidad);
        $this->emitTo('cart.index','render');
   }

    public function addToCart($product_id){
        $carrito = new CarritoController();
        $carrito->addToCart($product_id  ,1);
        $this->emitTo('cart.index','render');
        $this->dispatchBrowserEvent('alerta_timer', [
            'icon' => 'success',
            'msj' => "Agregado al carrito",
        ]);
        $this->dispatchBrowserEvent('jsHiddenAgregar',[
            'pid' =>$product_id,
        ]);
       
    }
   public function removeFromCart2($product_id){
       $carrito = new CarritoController();
       $carrito->deleteFromCart($product_id);
       $this->emitTo('cart.index','render');
      
       $this->dispatchBrowserEvent('alerta_timer', [
            'icon' => 'success',
            'msj' => "Eliminado del carrito",
        ]); 
        $this->dispatchBrowserEvent('jsShowAgregar',[
            'pid' =>$product_id,
        ]);
   }

   public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }
    public static function fechaHora($fecha){
        return Carbon::createFromFormat('Y-m-d H:i:s', $fecha)->locale('es')->timezone('America/Santiago');
    }


}

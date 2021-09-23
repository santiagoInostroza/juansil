<?php

namespace App\Http\Livewire\Admin\Inventario;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\StockInventory;
use Livewire\Component;

class Index extends Component{

    public $mostrarTodosLosProductos = true;
    public $search;
    public $order_by = "name";
    public $asc = 'asc';
    
    public function render(){

        $str = explode(' ', $this->search);

        $products = Product::where(function($query) use($str) {
            foreach($str as $s) {
                $query = $query->where('products.name','like',"%" . $s . "%");
            }
        })
        ->with('purchasePrices')
        ->orderBy($this->order_by,$this->asc)->get();;



        return view('livewire.admin.inventario.index',compact('products'));
    }
    public function desactivar($product_id){
        $product = Product::find($product_id);
        $product->status = 0;
        $product->save();
    }
    public function activar($product_id){
        $product = Product::find($product_id);
        $product->status = 1;
        $product->save();
    }

    
    public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }

    public function actualizateStock($product_id, $quantity){
        $stock = new StockInventory();
        $stock->product_id = $product_id;
        $stock->quantity = $quantity;
        $stock->user_id = auth()->user()->id;
        $stock->date = Carbon::now();
        $stock->save();
        
       
    }
}

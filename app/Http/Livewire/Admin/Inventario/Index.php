<?php

namespace App\Http\Livewire\Admin\Inventario;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\PurchasePrice;
use App\Models\StockInventory;
use App\Http\Controllers\Admin\InventarioController;

class Index extends Component{

    public $mostrarTodosLosProductos = true;
    public $search;
    public $order_by = "name";
    public $asc = 'asc';

    public $commentAjuste="";
    
    public function render(){

        $str = explode(' ', $this->search);

        $products = Product::where(function($query) use($str) {
            foreach($str as $s) {
                $query = $query->where('products.name','like',"%" . $s . "%");
            }
        })
        ->with('purchasePrices')
        ->orderBy($this->order_by,$this->asc)->get();
        
        $sales = Sale::with('saleItems')->where('delivery','1')->where('delivery_stage','!=','1')->orWhere('delivery_stage', null)->get();
        

        return view('livewire.admin.inventario.index',compact('products','sales'));
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
        $products = PurchasePrice::where('product_id',$product_id)->where('stock','>',0)->get();

        
        $stockTotal = 0;
        $precioTotal = 0;
        foreach ($products as $product) {
           $precioTotal +=  $product->precio * $product->stock;
           $stockTotal +=  $product->stock;
        }
        try {
            $cost= $precioTotal / $stockTotal;
        } catch (\Throwable $th) {
           $cost = 0;
        }
        
        
        $stock = new StockInventory();
        $stock->product_id = $product_id;
        $stock->quantity = $quantity;
        $stock->cost = $cost;
        $stock->user_id = auth()->user()->id;
        $stock->date = Carbon::now();
        $stock->save();
        
       
    }

    public function ajustarStock($product_id, $quantity){
        $inventoryController = new InventarioController();
        $inventoryController->ajustarStock($product_id, $quantity, $this->commentAjuste);

    }

    public function setStockTemp($product_id, $stockTemp){
        $product = Product::find($product_id);
        $product->stockTemp = $stockTemp;
        $product->stockTempUser = auth()->user()->id;
        $product->stockTempDate = Carbon::now();
        $product->save();
        
    }
}

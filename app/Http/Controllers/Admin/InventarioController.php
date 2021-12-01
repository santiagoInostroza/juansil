<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\AjusteStock;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use App\Http\Controllers\Controller;

class InventarioController extends Controller{

    public function index(){

       
        return view('admin.inventario.index');
    }

    public function restaurarStock(Purchase $purchase){
        // RESTA STOCK
        foreach ($purchase->purchase_items as $key => $value) {
           $product_id = $value->product_id;
           $cantidad = $value->cantidad_total;
           $precio = $value->precio;
           
           $product = Product::find($product_id);
           $product->stock-=$cantidad;
           $product->save();

           $productPurchasePrice = PurchasePrice::where('product_id',$product_id)->where('precio',$precio)->first();
           if($productPurchasePrice){
               $productPurchasePrice->stock-=$cantidad;
           }else{
               $productPurchasePrice = new PurchasePrice();
               $productPurchasePrice->product->id = $product_id;
               $productPurchasePrice->product->precio = $precio;
               $productPurchasePrice->product->precio_por_caja = 0;
               $productPurchasePrice->product->stock = $cantidad;
           }
           $productPurchasePrice->save();
        }
       

    }

    public function ajustarStock($product_id, $quantity,$comments = null){
        $product = Product::find($product_id);
        $diferencia = $product->stock - $quantity;
        $diferencia3 = $diferencia *-1;

        $precioProducto=0;

        if ($diferencia>0) { //disminuir stock
            $purchasePrice = PurchasePrice::where('product_id',$product_id)->where('stock','>',0)->orderBy('fecha','asc')->get();
            foreach ($purchasePrice as  $product2) {
                if($product2->stock >= $diferencia){
                    $product2->stock -= $diferencia;
                    $product2->save();
                    $precioProducto= $product2->precio;
                    break;
                }else{
                    $diferencia -= $product2->stock;
                    $product2->stock = 0;
                    $product2->save();
                }              
            }
            
        }elseif ($diferencia<0){ //aumentar stock
            $diferencia2 = $diferencia*-1;
            $purchasePrice = PurchasePrice::where('product_id',$product_id)->orderBy('fecha','desc')->first();
            $purchasePrice->stock += $diferencia2;
            $precioProducto=$purchasePrice->precio;
            $purchasePrice->save();
        }

       

        $product->stock = $quantity;
        $product->ajuste++;
        $product->cantAjuste += $diferencia3;
        $product->totalAjuste += $precioProducto * $diferencia3;
        $product->save();

        $ajuste = new AjusteStock();
        $ajuste->product_id = $product_id;
        $ajuste->quantity = $diferencia3;
        $ajuste->total = $precioProducto * $diferencia3;
        $ajuste->date = Carbon::now();
        $ajuste->comments = $comments;
        $ajuste->user_id = auth()->user()->id;
        $ajuste->save();
        

    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use App\Http\Controllers\Controller;

class InventarioController extends Controller{

    public function index(){

        $products = Product::all();
        return view('admin.inventario.index', compact('products'));
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

    public function ajustarStock($product_id, $quantity){
        $product = Product::find($product_id);
        $diferencia = $product->stock - $quantity;

        $product->stock = $quantity;
        $product->save();

        if ($diferencia>0) { //disminuir stock
            $purchasePrice = PurchasePrice::where('product_id',$product_id)->where('stock','>',0)->orderBy('fecha','asc')->get();
            foreach ($purchasePrice as  $product) {
                if($product->stock >= $diferencia){
                    $product->stock -= $diferencia;
                    $product->save();
                    break;
                }else{
                    $diferencia -= $product->stock;
                    $product->stock = 0;
                    $product->save();
                }              
            }
            
        }elseif ($diferencia<0){ //aumentar stock
            $diferencia = $diferencia*-1;
            $purchasePrice = PurchasePrice::where('product_id',$product_id)->orderBy('fecha','desc')->first();
            $purchasePrice->stock += $diferencia;
            $purchasePrice->save();
        }

       
        

    }

}

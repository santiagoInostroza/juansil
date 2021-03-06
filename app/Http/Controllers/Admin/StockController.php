<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.stock.index', compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }
    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
     
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



}

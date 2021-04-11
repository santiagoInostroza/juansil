<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\SalePrice;
use App\Models\CustomerData;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use Illuminate\Support\Carbon;
use App\Models\ProductMovement;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Admin\SupplierController;

class DatatableController extends Controller
{
   
    public function productos()
    {

        return Datatables::of(Product::all())

            ->addColumn('image', function ($product) {
                return view('partials/datatables/products/image', compact('product'));
            })
            ->addColumn('brand', function ($product) {
                if (isset($product->brand->name)) {
                    return $product->brand->name;
                } else {
                    return "";
                }
            })
            ->addColumn('category', function ($product) {
                if (isset($product->category->name)) {
                    return $product->category->name;
                } else {
                    return "";
                }
            })
            ->addColumn('tags', function ($product) {
                return view('partials/datatables/products/tags', compact('product'));
            })
            ->addColumn('prices', function ($product) {
                return view('partials/datatables/products/prices', compact('product'));
            })
            ->addColumn('action', function ($product) {
                return view('partials/datatables/products/action', compact('product'));
            })
            ->make(true);
    }

    public function proveedores()
    {

        return Datatables::of(Supplier::all())
            ->addColumn('action', function ($supplier) {
                return view('partials/datatables/suppliers/action', compact('supplier'));
            })
            ->make(true);
    }



    public function compras()
    {

        return Datatables::of(Purchase::all())


            ->addColumn('supplier_id', function ($compra) {

                return $compra->supplier->name;
            })
            ->addColumn('total', function ($compra) {

               
                return "$ " . number_format($compra->total,0,',','.');
            })
            ->addColumn('action', function ($compra) {
        
                return view('partials/datatables/purchases/action', compact('compra'));
            })
            ->make(true);
    }


    public function movimientos(){

        return Datatables::of(ProductMovement::all())


            ->addColumn('id_movimiento', function ($movimiento) {

                if($movimiento->movement_type == "Compra" || $movimiento->movement_type == "Ajuste Stock de Ingreso"){
                    $movement= Purchase::where('id',$movimiento->movement_id)->first();
                    
                }else  if($movimiento->movement_type == "Venta" || $movimiento->movement_type == "Ajuste Stock de Salida"){
                    $movement= Sale::where('id',$movimiento->movement_id)->first();
                }
                return view('partials/datatables/movements/tipo', compact('movimiento','movement'));
            })
            ->addColumn('price', function ($movimiento) {
               
                return "$ ". number_format($movimiento->price,0,',','.');
            })
            ->addColumn('cantidad', function ($movimiento) {
                
                return view('partials/datatables/movements/cantidad', compact('movimiento'));
            })
           
            ->addColumn('product', function ($movimiento) {

                
                return view('partials/datatables/movements/products', compact('movimiento'));
            })
            ->addColumn('fecha', function ($movimiento) {
                return view('partials/datatables/movements/fecha', compact('movimiento'));
               
            })
            // ->addColumn('action', function ($movimiento) {
        
            //     return view('partials/datatables/movements/action', compact('movimiento'));
            // })
            ->make(true);
    }


    public function stock(){
        return Datatables::of(PurchasePrice::all())
            ->addColumn('image', function ($stock) {
                return view('partials/datatables/stock/imagen', compact('stock'));
            })
            ->addColumn('product', function ($stock) {
                $product = Product::where("id",$stock->product_id)->first();
                return view('partials/datatables/stock/product', compact('stock','product')); 
            })
            ->addColumn('price', function ($stock) {
                return  "$ " . number_format($stock->precio,0,',','.');
            })
            ->addColumn('stock', function ($stock) {   
                return view('partials/datatables/stock/stock', compact('stock'));
            })
            ->addColumn('total', function ($stock) {  
                return  "$ " . number_format(($stock->stock * $stock->precio),0,',','.');
            })
            ->addColumn('sale_price', function ($stock) {
                return view('partials/datatables/stock/sale_prices', compact('stock'));
            })
            ->make(true);
    }


    // public function clientes(){
    //     return Datatables::of(Customer::all())
           
    //         ->addColumn('action', function ($cliente) {
    //             return view('partials/datatables/customers/action', compact('cliente'));
    //         })
    //         ->make(true);
    // }
    public function ventas(){

        return Datatables::of(Sale::all())
           
            ->addColumn('customer', function ($venta) {
                
                return  view('partials/datatables/sales/customer', compact('venta'));
            })
            ->addColumn('total', function ($venta) {
                return "$" .  number_format($venta->total,0,',','.');
            })
            ->addColumn('date', function ($venta) {
                return  date("d-m-Y",strtotime($venta->date)) ;
            })
            ->addColumn('payment_status', function ($venta) {
                return  view('partials/datatables/sales/payment_status', compact('venta'));
            })
            ->addColumn('payment_amount', function ($venta) {
                return  "$" .  number_format($venta->payment_amount,0,',','.');
            })
            ->addColumn('pending_amount', function ($venta) {
                return  "$" .  number_format($venta->pending_amount,0,',','.');
            })
            ->addColumn('delivery', function ($venta) {
                return  view('partials/datatables/sales/delivery', compact('venta'));
            })
            ->addColumn('user_created', function ($venta) {
               try {
                $user = User::find($venta->user_created);
                return  $user->name;
               } catch (\Throwable $th) {
                  return"";
               } 
            })
            ->addColumn('action', function ($venta) {
                return view('partials/datatables/sales/action', compact('venta'));
            })
            ->make(true);
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use App\Models\ProductPurchase;
use App\Http\Controllers\Controller;
use App\Models\ProductMovement;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();


        return view('admin.purchases.index', compact('purchases'));
    }
    public function create($proveedor_id ="")
    {
        $suppliers = Supplier::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        return view('admin.purchases.create', compact('suppliers', 'products','proveedor_id'));
    }



    public function store(Request $request){
    //return $request->all();
        $request->validate([
            'supplier_id' => 'required',
            'fecha' => 'required',
            'total' => 'required'
        ]);

        $purchase = Purchase::create($request->all());
        
        $movement_type=($request->supplier_id==1)?"Ajuste Stock de Salida":"Compra";
        

        for ($i = 0; $i < count($request->products); $i++) {

            $this->actualizarPrecioCompra($request->products[$i], $request->precio[$i], $request->precio_por_caja[$i], $request->cantidad_total[$i]);
            $this->actualizarMovimientoProductos($movement_type,$request->products[$i], $request->precio[$i], $request->cantidad_total[$i], $purchase->id);
          
            $item = ProductPurchase::create([
                'purchase_id' =>$purchase->id,
                'product_id' =>$request->products[$i],
                'cantidad' => $request->cantidad[$i],
                'cantidad_por_caja' => $request->cantidad_por_caja[$i],
                'cantidad_total' => $request->cantidad_total[$i],
                'precio' => $request->precio[$i],
                'precio_por_caja' => $request->precio_por_caja[$i],
                'total' => $request->total_producto[$i],
            ]); 
        }

        return redirect()->route('admin.purchases.edit', $purchase)->with('info', "Compra '$purchase->id' registrada correctamente");
    }


    public function show(Purchase $compra)
    {
        return "Mostrar";
    }



    public function edit(Purchase $compra)
    {
        $suppliers = Supplier::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        
        $proveedor_id = $compra->supplier->id;

        return view('admin.purchases.edit', compact('compra', 'suppliers', 'products','proveedor_id'));
    }



    public function update(Request $request, Purchase $compra)
    {
        //return $compra;
        //VALIDAR
        $request->validate([
            'supplier_id' => 'required',
            'fecha' => 'required',
            'total' => 'required'
        ]);

        //ACTUALIZAR COMPRA
        $compra->update($request->all());

        $movement_type=($request->supplier_id==1)?"Ajuste Stock de Salida":"Compra";
       

        for ($i = 0; $i < count($request->products); $i++) {

            $producto_nuevo = $request->products[$i];
            $precio_nuevo = $request->precio[$i];
            $precio_por_caja_nuevo = $request->precio_por_caja[$i];
            $cantidad_nuevo = $request->cantidad_total[$i];

            $array[$producto_nuevo] = [
                'cantidad' => $request->cantidad[$i],
                'cantidad_por_caja' => $request->cantidad_por_caja[$i],
                'cantidad_total' => $cantidad_nuevo,
                'precio' => $request->precio[$i],
                'precio_por_caja' => $precio_por_caja_nuevo,
                'total' => $request->total_producto[$i],
            ];
            if ($request->id[$i] > 0) {
                $detalle_compra = ProductPurchase::where('id', $request->id[$i])->first(); //OBTENER COMPRA DE PRODUCTO ACTUAL

                $precio = $detalle_compra->precio;
                $producto = $detalle_compra->product_id;
                $cantidad = $detalle_compra->cantidad_total;

                $modificarPrecio = ($precio != $precio_nuevo || $producto != $producto_nuevo || $cantidad != $cantidad_nuevo) ? true : false;

                if ($modificarPrecio) { //SI HAY ALGUN CAMBIO ENTRA ACÁ
                    $this->devolverStockEstadoAnterior($producto, $precio, $cantidad);
                    $this->actualizarMovimientoProductos($movement_type,$producto, $precio, ($cantidad * -1), $compra->id, "se descuenta stock por que se edita item");

                    $this->actualizarPrecioCompra($producto_nuevo, $precio_nuevo, $precio_por_caja_nuevo, $cantidad_nuevo);
                    $this->actualizarMovimientoProductos($movement_type,$producto_nuevo, $precio_nuevo, $cantidad_nuevo, $compra->id, "se aumenta stock porque se edita item");
                }
            } else {
                $this->actualizarPrecioCompra($producto_nuevo, $precio_nuevo, $precio_por_caja_nuevo, $cantidad_nuevo);
                $this->actualizarMovimientoProductos($movement_type,$producto_nuevo, $precio_nuevo, $cantidad_nuevo, $compra->id,"se agrega este producto en editar compra");
            }
        }

        //DEVOLVER STOCK DE PRODUCTOS ELIMINADOS
        $detalle_compra_eliminados = ProductPurchase::whereIn('id', explode(',', $request->eliminados))->get(); //OBTENER COMPRA DE PRODUCTO eliminados
        foreach ($detalle_compra_eliminados as $value) {
            $this->devolverStockEstadoAnterior($value->product_id, $value->precio, $value->cantidad_total);
            $this->actualizarMovimientoProductos($movement_type,$value->product_id, $value->precio, ($value->cantidad_total * -1), $compra->id,"item eliminado");
        }

        $compra->products()->sync($array); 

        return redirect()->route('admin.purchases.edit', $compra)->with('info', "Compra '$compra->id' Se actualizó correctamente");
    }



    public function destroy(Purchase $compra)
    {
        $id = $compra->id;
        $items = ProductPurchase::where('purchase_id',$id)->get();
        foreach ($items as $value) {
            $this->devolverStockEstadoAnterior($value->product_id, $value->precio, $value->cantidad_total);
            $this->actualizarMovimientoProductos($value->product_id, $value->precio, ($value->cantidad_total * -1), $id,"compra eliminada");
        }
        $compra->delete();
        return redirect()->route('admin.purchases.index')->with('info', "Compra '$id' eliminada correctamente");
    }



    public function devolverStockEstadoAnterior($producto, $precio, $cantidad){
        $precio_compra = PurchasePrice::where(['precio' => $precio, 'product_id' => $producto])->first();
        
        try { //REGRESAR STOCK AL ESTADO ANTERIOR 
            $stock = $precio_compra->stock;
            $precio_compra->stock  = $stock - $cantidad;
            $precio_compra->save();
        } catch (\Throwable $th) {}
        
    }

    public function actualizarPrecioCompra($producto_nuevo, $precio_nuevo, $precio_por_caja_nuevo, $cantidad_nuevo){
        $precio = PurchasePrice::where('precio', $precio_nuevo)->where('product_id', $producto_nuevo)->first();
        try {
            //ACTUALIZAR PRECIO Y STOCK
            $stock = $precio->stock;
            $stock_nuevo = $stock + $cantidad_nuevo;

            $precio->stock = $stock_nuevo;
            $precio->save();
        } catch (\Throwable $th) {
            //CREA NUEVO PRECIO Y STOCK
            $precio = PurchasePrice::create([
                'product_id' => $producto_nuevo,
                'precio' => $precio_nuevo,
                'precio_por_caja' =>  $precio_por_caja_nuevo,
                'stock' => $cantidad_nuevo,
            ]);
        }
    }

    public function actualizarMovimientoProductos($movement_type,$product_id, $precio, $cantidad, $purchase_id,  $observacion=""){
        $movimientoProducto = ProductMovement::where('product_id', $product_id)->latest('id')->first();
       
        $stock = 0;
        try {
            $stock = $movimientoProducto->stock_actual;
        } catch (\Throwable $th) {
            $stock = 0;
        }
        $stock_nuevo = $stock + $cantidad;
        ProductMovement::create([
            'product_id' => $product_id,
            'price' => $precio,
            'movement_id' => $purchase_id,
            'movement_type' => $movement_type,
            'stock_anterior' =>  $stock,
            'cantidad' => $cantidad,
            'stock_actual' => $stock_nuevo,
            'observacion' => $observacion,
        ]);

        $product= Product::where("id",$product_id)->first();
        $product->stock = $stock_nuevo;
        $product->save();
    }


  

}

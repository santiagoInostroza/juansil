<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use App\Models\ProductMovement;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{

    public $total_venta = 0;
    public $total_compra = 0;
    public $diferencia = 0;

    public function index(){
        $sales = Sale::all();
        $diferencia = 0;
        $total_compra = 0;
        foreach ( $sales as $items) {
            foreach ($items->sale_items as $item) {
                $this->total_venta  +=  $item->precio_total;
                if(isset($item->product->purchasePrices[0])){
                    $total_compra += $item->cantidad_total * $item->product->purchasePrices[0]->precio;
                }
                $diferencia += $item->precio_total - ($item->cantidad_total * $item->product->purchasePrices[0]->precio);       
            
            }
        }
       

        return view('admin.sales.index', compact('sales','diferencia','total_compra'));
    }


    public function create( $cliente_id ="" )
    {
       
        $customers = Customer::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        return view('admin.sales.create', compact('customers', 'products','cliente_id') );
    }

    public function store(Request $request){
       
        // return $request->all();
        $request->validate([
            'customer_id' => 'required',
            'date' => 'required',
            'total' => 'required'
        ]);


        $payment_amount = 0;
        $delivery = (isset($request->delivery) && $request->delivery == 'on') ? 1 : 0;
        if ($request->payment_status == 2) {
            $payment_amount = $request->abono;
        } else if ($request->payment_status == 3) {
            $payment_amount = $request->total;
        }

        $pending_amount = $request->total -  $payment_amount;
        $delivery_date = ($delivery == 1) ? $request->delivery_date : null;
        $delivery_stage = (isset($request->delivery_stage) && $request->delivery_stage == 'on') ? 1 : 0;
        $payment_date=($request->payment_status==3) ? Carbon::now()->toDateString(): null;

        //CREA LA VENTA
        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'total' => $request->total,
            'date' => $request->date,
            'payment_amount' => $payment_amount,
            'payment_status' => $request->payment_status,
            'pending_amount' => $pending_amount,
            'payment_date' => $payment_date,
            'delivery' => $delivery,
            'delivery_date' => $delivery_date,
            'delivery_stage' => $delivery_stage,
            'comments' => $request->comments,
        ]);

        //CREA LOS ITEMS DE VENTA
        for ($i = 0; $i < count($request->products); $i++) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $request->products[$i],
                'cantidad' => $request->cantidad[$i],
                'cantidad_por_caja' => $request->cantidad_por_caja[$i],
                'cantidad_total' => $request->cantidad_total[$i],
                'precio' => $request->precio[$i],
                'precio_por_caja' => $request->precio_por_caja[$i],
                'precio_total' => $request->precio_total[$i],
            ]);

            $movement_type = ($request->customer_id==1)?"Ajuste Stock de Salida":'Venta';
            $movement_id = $sale->id;
            $product_id = $request->products[$i];
            $cantidad = $request->cantidad_total[$i];
            $observacion = "";

            //ACTUALIZA STOCKS Y GENERA LOS RESPECTIVOS MOVIMIENTOS
            $this->actualizarStockYMovimientos($movement_type, $movement_id, $product_id, $cantidad *-1, $observacion);
        }


        return redirect()->route('admin.sales.edit', $sale)->with('info', "Venta '$sale->id' registrada correctamente");
    }


    public function show(Sale $venta)
    {
        //
    }

    public function edit(Sale $venta)
    {

        $customers = Customer::pluck('name', 'id');
        return view('admin.sales.edit', compact('venta', 'customers'));
    }




    public function update(Request $request, Sale $venta)
    {
        //return $request->all();
        $request->validate([
            'customer_id' => 'required',
            'date' => 'required',
            'total' => 'required'
        ]);

        //ACTUALIZAR COMPRA        
        $payment_amount = 0;
        $delivery = (isset($request->delivery) && $request->delivery == 'on') ? 1 : 0;
        if ($request->payment_status == 2) {
            $payment_amount = $request->abono;
        } else if ($request->payment_status == 3) {
            $payment_amount = $request->total;
        }
        
        $pending_amount = $request->total -  $payment_amount;
        $delivery_date = ($delivery == 1) ? $request->delivery_date : null;
        $delivery_stage = (isset($request->delivery_stage) && $request->delivery_stage == 'on') ? 1 : 0;
        
        //CREA LA VENTA

    
            $venta->update([
                'customer_id' => $request->customer_id,
                'total' => $request->total,
                'date' => $request->date,
                'payment_amount' => $payment_amount,
                'payment_status' => $request->payment_status,
                'pending_amount' => $pending_amount,
                'delivery' => $delivery,
                'delivery_date' => $delivery_date,
                'delivery_stage' => $delivery_stage,
                'comments' => $request->comments,
            ]);

           
                $movement_type=( $request->customer_id==1 )?"Ajuste Stock de Salida":'Venta';
          
            

        for ($i = 0; $i < count($request->products); $i++) {

            $producto_nuevo = $request->products[$i];
            $precio_nuevo = $request->precio[$i];
            $precio_por_caja_nuevo = $request->precio_por_caja[$i];
            $cantidad_nuevo = $request->cantidad_total[$i];
        
            if ($request->id[$i] > 0) { //si el item es antiguo entra, si es nuevo se salta este paso
                $item = SaleItem::where('id', $request->id[$i])->first(); //OBTENER VENTA DE PRODUCTO ACTUAL

                $precio = $item->precio;
                $producto = $item->product_id;
                $cantidad = $item->cantidad_total;

                $modificarPrecio = (/*$precio != $precio_nuevo ||*/ $producto != $producto_nuevo || $cantidad != $cantidad_nuevo) ? true : false;

                if ($modificarPrecio) { //SI HAY ALGUN CAMBIO ENTRA ACÁ
                    //PRIMERO SE DEVUELVE EL STOCK DE PRODUCTOS     
                    $this->actualizarStockYMovimientos($movement_type, $venta->id,$producto, $cantidad, "Item modificado, se restaura a stock anterior");//ACTUALIZA STOCKS Y GENERA LOS RESPECTIVOS MOVIMIENTOS
                    //LUEGO SE DESCUENTA EL STOCK DE LOS PRODUCTOS QUE CORRESPONDE
                    $this->actualizarStockYMovimientos($movement_type, $venta->id, $producto_nuevo, $cantidad_nuevo *-1, "Este es el item nuevo que se agrega"); //ACTUALIZA STOCKS Y GENERA LOS RESPECTIVOS MOVIMIENTOS
                }
            } else {
                $this->actualizarStockYMovimientos($movement_type, $venta->id, $producto_nuevo, $cantidad_nuevo *-1, "Se agrega este item en la edicion de la venta"); //ACTUALIZA STOCKS Y GENERA LOS RESPECTIVOS MOVIMIENTOS
            }
        }
        //DEVOLVER STOCK DE PRODUCTOS ELIMINADOS
        $items_eliminados = SaleItem::whereIn('id', explode(',', $request->eliminados))->get(); //OBTENER COMPRA DE PRODUCTO eliminados
        foreach ($items_eliminados as $value) {  //ACTUALIZA STOCKS Y GENERA LOS RESPECTIVOS MOVIMIENTOS
            $this->actualizarStockYMovimientos($movement_type, $venta->id, $value->product_id, $value->cantidad_total, "Item eliminado");
        }

        $venta->sale_items()->delete();
        for ($i = 0; $i < count($request->products); $i++) {

            $producto_nuevo = $request->products[$i];
            $precio_nuevo = $request->precio[$i];
            $precio_por_caja_nuevo = $request->precio_por_caja[$i];
            $cantidad_nuevo = $request->cantidad_total[$i];
            
            $venta->sale_items()->create([
                'product_id' => $producto_nuevo,
                'cantidad' => $request->cantidad[$i],
                'cantidad_por_caja' =>$request->cantidad_por_caja[$i],
                'cantidad_total' =>$cantidad_nuevo,
                'precio' =>$request->precio[$i],
                'precio_por_caja' =>$precio_por_caja_nuevo,
                'precio_total' =>$request->precio_total[$i],
            ]);
        }

        return redirect()->route('admin.sales.edit', $venta)->with('info', "Venta '$venta->id' Se actualizó correctamente");
    }





    public function destroy(Sale $venta)
    {
        $id= $venta->id;
        $venta->delete();
       return  redirect()->route('admin.sales.index')->with('info', "Venta '$id' eliminada correctamente");
    }





    public function getProductStock($product_id)
    {
        $producto =  Product::where('id', $product_id)->first();
        $stock = 0;
        try {
            $stock = $producto->stock;
        } catch (\Throwable $th) {
            $stock = 0;
        }
        return $stock;
    }
    public function getNewProductStock($product_id, $nueva_cantidad)
    {
        $producto =  Product::where('id', $product_id)->first();
        $stock = 0;
        try {
            $stock = $producto->stock;
        } catch (\Throwable $th) {
            $stock = 0;
        }

        return $stock + $nueva_cantidad;
    }

    public function updateProductStock($product_id, $nueva_cantidad)
    {
        $producto =  Product::where('id', $product_id)->first();
        $stock = 0;
        try {
            $stock = $producto->stock;
        } catch (\Throwable $th) {
            $stock = 0;
        }

        $producto->stock = $stock + $nueva_cantidad;
        $producto->save();
        return $producto->stock;
    }


    public function actualizarStockYMovimientos($movement_type, $movement_id, $product_id, $cantidad, $observacion = "")
    {
        //$product_id = $request->products[$i];
        //$movement_id = $sale->id; // id de compra o venta segun el caso
        //$movement_type = 'Venta'; // compra o venta segun el caso
        //$cantidad = $request->cantidad_total[$i];
        //$observacion = ""; // pequeña descripcion desde donde se origina el movimiento

      

        $stock = $this->getProductStock($product_id);
        $this->updateProductStock($product_id, $cantidad);

        //ACTUALIZAR STOCK DE PRECIO PRODUCTO
        $go = true;
        do {
            $itemPrecioCompra = PurchasePrice::where('product_id', $product_id)->where('stock', '>', 0)->orderBy('created_at', 'asc')->first();
            $cantidadGuardada = $cantidad;
            try {
                $stockPrecioCompra = $itemPrecioCompra->stock;
                $stockPrecioCompraActual = $stockPrecioCompra + $cantidad;
                $precio_compra = $itemPrecioCompra->precio;


                if ($stockPrecioCompraActual < 0) {

                    $itemPrecioCompra->stock = 0;
                    $itemPrecioCompra->save();
                    $cantidadGuardada = $cantidad - $stockPrecioCompraActual;
                    $cantidad = $stockPrecioCompraActual;
                } else {
                    $go = false;
                    $itemPrecioCompra->stock = $stockPrecioCompraActual;
                    $itemPrecioCompra->save();
                }
            } catch (\Throwable $th) {
                try {
                    $itemPrecioCompra = PurchasePrice::where('product_id', $product_id)->orderBy('created_at', 'asc')->first();
                    $stockPrecioCompra = $itemPrecioCompra->stock;
                    $stockPrecioCompraActual = $stockPrecioCompra + $cantidad;
                    $itemPrecioCompra->stock = $stockPrecioCompraActual;
                    $itemPrecioCompra->save();
                    $cantidadGuardada = $cantidad;
                    $precio_compra = $itemPrecioCompra->precio;
                } catch (\Throwable $th) {
                    $stockPrecioCompra = 0;
                    $stockPrecioCompraActual = $stockPrecioCompra + $cantidad;
                    $cantidadGuardada = $cantidad;
                    $precio_compra = 0;
                    $observacion="Puede que exista algun error en este item, ya que no se encontro el registro del producto";
                }
                $go = false;
               

            }



            //REGISTRAR MOVIMIENTO
            $stock_actual = $stock + $cantidadGuardada;
            ProductMovement::create([
                'product_id' => $product_id,
                'price' => $precio_compra,
                'movement_id' => $movement_id,
                'movement_type' => $movement_type,
                'stock_anterior' =>  $stock,
                'cantidad' => $cantidadGuardada,
                'stock_actual' => $stock_actual,
                'observacion' => $observacion,
            ]);
            $stock = $stock_actual;
        } while ($go);
    }
}

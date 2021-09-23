<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleItem;
use App\Models\ErrorNotice;
use App\Models\MovementSale;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use App\Models\ProductMovement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SaleNotification;

class SaleController extends Controller{

    public function index(){
        return view('admin.sales.index');
    }

    public function pagosPendientes(){
        return view('admin.sales.pagos_pendientes');
    }


    public function create( $cliente_id ="" ){
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
            'user_created' => Auth::user()->id,
            
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


    public function show(Sale $venta){
        //
    }

    public function edit(Sale $venta){
        
        $customers = Customer::pluck('name', 'id');
        return view('admin.sales.edit', compact('venta', 'customers'));
    }




    public function update(Request $request, Sale $venta){

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
            $payment_amount =$venta->payment_amount + $request->payment_amount;

        } else if ($request->payment_status == 3) {
            $payment_amount = $request->total;
        }
        
        $pending_amount = $request->total -  $payment_amount;
        $delivery_date = ($delivery == 1) ? $request->delivery_date : null;
        $delivery_stage = (isset($request->delivery_stage) && $request->delivery_stage == 'on') ? 1 : 0;
        
        //ACTUALIZA LA VENTA

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
                'user_modified' => Auth::user()->id,
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


    public function actualizarStockYMovimientos($movement_type, $movement_id, $product_id, $cantidad, $observacion = ""){
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

    public function createSale($arrayVenta){

        $sale = new Sale();

        $sale->customer_id             = $arrayVenta['sale']['customer_id'];
        $sale->total                   = $arrayVenta['sale']['total'];
        $sale->date                    = $arrayVenta['sale']['date'];
        $sale->payment_amount          = $arrayVenta['sale']['payment_amount'];
        $sale->payment_status          = $arrayVenta['sale']['payment_status'];
        $sale->pending_amount          = $arrayVenta['sale']['pending_amount'];
        $sale->payment_date            = $arrayVenta['sale']['payment_date'];
        $sale->delivery                = $arrayVenta['sale']['delivery'];
        $sale->delivery_date           = $arrayVenta['sale']['delivery_date'];
        $sale->date_delivered          = $arrayVenta['sale']['date_delivered'];
        $sale->delivery_stage          = $arrayVenta['sale']['delivery_stage'];
        $sale->comments                = $arrayVenta['sale']['comments'];
        $sale->user_created            = $arrayVenta['sale']['user_created'];
        $sale->delivery_value          = $arrayVenta['sale']['delivery_value'];
        $sale->subtotal                = $arrayVenta['sale']['subtotal'];
        $sale->delivered_user          = $arrayVenta['sale']['delivered_user'];
        $sale->sale_type               =(isset($arrayVenta['sale']['sale_type']))? $arrayVenta['sale']['sale_type']:'1';
        $sale->save();



        $total_cost = 0;
        foreach ($arrayVenta['items'] as $item) {

            $product = Product::find($item['product_id']);
            $product->stock -= $item['cantidad_total'];
            $product->save();


            $go = true;
            $cantidad_restante = 0;
            $suma_costo = 0;
            $costo=0;
            $cantidad = 0;
            $vueltas = 0;
           
            try {//intenta obtener el valor de costo del producto
                do {
                    $purchasePrice = PurchasePrice::where('product_id', $item['product_id'])->where('stock', '>', 0)->orderBy('fecha', 'asc')->first();    
                    $cantidad = ($cantidad_restante == 0) ? $item['cantidad_total'] : $cantidad_restante ;
                    
                    $cantidad_a_multiplicar = 0;
                    $costo = $purchasePrice->precio;
                    $costo2 = $purchasePrice->precio;
                    if($purchasePrice->stock >= $cantidad){//alcanza para cubrir el stock necesitado
                        $cantidad_a_multiplicar = $cantidad;
                        $purchasePrice->stock -= $cantidad;
                        $go = false;

                    }else{ // no alcanza el stock, es necesario obtener otro producto para ocupar su stock
                        $cantidad_restante =  $cantidad - $purchasePrice->stock;
                        $cantidad_a_multiplicar = $purchasePrice->stock;
                        $purchasePrice->stock = 0; 
                    }
                    // ACTUALIZA STOCK DEL PRODUCTO INTERNO
                    $purchasePrice->save();

                    $movement_sales = new MovementSale();
                    $movement_sales->purchase_price_id = $purchasePrice->id;
                    $movement_sales->sale_id = $sale->id;
                    $movement_sales->product_id = $item['product_id'];
                    $movement_sales->fecha = $sale->date ;
                    $movement_sales->cantidad = $cantidad_a_multiplicar ;
                    $movement_sales->cost = $purchasePrice->precio ;
                    $movement_sales->total_cost = $purchasePrice->precio * $cantidad_a_multiplicar ;
                    $movement_sales->save();

                    $total_costo = $cantidad_a_multiplicar * $costo;
                    $suma_costo += $total_costo;
                    $vueltas++;
                } while ($go); 

                $costo_final_unitario =$suma_costo / $item['cantidad_total'];
                $total_cost += $suma_costo;

            } catch (\Throwable $th) { //si encuentra un costo pero el stock no es suficiente, guarda todos los costos con el valor que encontro, si no encuentra ni un costo guarda el valor del costo al valor del precio venta
                if($vueltas>0){
                    $costo_final_unitario = $costo2;
                    // $this->msj.= "Stock insuficiente de '$producto_general->name'.\n";
                    $message = new ErrorNotice();
                    $message->message = "No se encontró stock suficiente para $product->name en venta $sale->id. Se guardará el valor de costo del producto de un producto encontrado sin stock. se guarda purchase_price_id como nulo en movement_sales";
                    $message->save();

                }else{
                    $costo_final_unitario = $item['precio'];
                    $total_cost += ($item['precio'] * $item['cantidad_total']); 
                    // $this->msj.= "No se encontro stock de '$producto_general->name'.\n";
                    $message = new ErrorNotice();
                    $message->message = "No se encontró stock para $product->name en venta $sale->id. Se guardará el precio de venta como precio de costo, esto ocasionará que no refleje utilidades este item. se guarda purchase_price_id como nulo en movement_sales";
                    $message->save();
                }

                $movement_sales = new MovementSale();
                $movement_sales->purchase_price_id = null;
                $movement_sales->sale_id = $sale->id;
                $movement_sales->product_id = $item['product_id'];
                $movement_sales->fecha = $sale->date ;
                $movement_sales->cantidad = $cantidad ;
                $movement_sales->cost = $costo_final_unitario ;
                $movement_sales->total_cost = $costo_final_unitario * $cantidad ;
                $movement_sales->save();

            }
           
            $saleItem = new SaleItem();

            $saleItem->sale_id              = $sale->id;
            $saleItem->product_id           = $item['product_id'];
            $saleItem->cantidad             = $item['cantidad'];
            $saleItem->cantidad_por_caja    = $item['cantidad_por_caja'];
            $saleItem->cantidad_total       = $item['cantidad_total'] ;
            $saleItem->precio               = $item['precio'] ;
            $saleItem->precio_por_caja      = $item['precio_por_caja'] ;
            $saleItem->precio_total         = $item['precio_total'] ;
            $saleItem->costo                = $costo_final_unitario;

            $saleItem->save();


        }

        $sale->total_cost = $total_cost;
        $sale->save();

        User::find(1)->notify(new SaleNotification($sale));

        return $sale;

      
        
    }

    public function deleteSale(Sale $sale){

        foreach ($sale->movement_sales as $movement) {
            try {
                // Cuando se guarda un movimiento sin encontrar stock purchase_price_id queda nulo por lo que cuando entre aqui buscando un purchase_price  arrojará un error
                $movement->purchase_price->stock+=$movement->cantidad; 
                $movement->purchase_price->save(); 
            } catch (\Throwable $th) {
              
            }
           
            $movement->product->stock += $movement->cantidad;
            $movement->product->save(); 
        }

        $sale->sale_items;
        $sale->delete();
        
    }
}

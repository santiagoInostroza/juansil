<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CarritoController extends Controller{

    public $eliminado;

    public function addToCart($product_id, $cantidad){
        $precio = $this->calcularPrecioVenta($product_id, $cantidad);
        $total = $precio * $cantidad;

        $listaProductos = session('carrito');

        $producto = Product::find($product_id);

        $listaProductos[$product_id] =
            [
                'producto_id' =>$product_id,
                'name' =>$producto->name,
                'url' =>$producto->image->url,
                'cantidad' => $cantidad,
                'precio' => $precio,
                'total' => $total,
            ];

        session([
            'carrito' => $listaProductos
        ]);

        $this->updateTotal();
        
    }

    public function updateTotal(){
        $totalCarrito = 0;
        $totalProductos = 0;
        foreach (session('carrito') as  $value) {
            $totalCarrito +=  $value['total'];
            $totalProductos+= $value['cantidad'];

        }
        session(['totalCarrito' => $totalCarrito]);
        session(['totalProductos' => $totalProductos]);
       
    }
    

    public function deleteFromCart($id){
        $this->eliminado = session()->pull('carrito.' . $id, 'default');
        // session()->forget('carrito.' . $id);
        $this->updateTotal();
    }

    public function setCantidad($product_id, $cantidad){
        $precio = $this->calcularPrecioVenta($product_id, $cantidad);
        $total = $precio * $cantidad;

        session(['carrito.' . $product_id . '.cantidad' => $cantidad]);
        session(['carrito.' . $product_id . '.precio' => $precio]);
        session(['carrito.' . $product_id . '.total' => $total]);
        $this->updateTotal();
    }
  


    /*
    calcular precio de venta de acuerdo a la cantidad de productos que lleva (precio de venta por mayor o por menor)
    */
    public function calcularPrecioVenta($product_id, $cantidad){
        $producto = Product::find($product_id);
        $precio = 0;
        for ($i=0; $i < count($producto->salePrices) ; $i++) { 

            $cant = $producto->salePrices[$i]['quantity'];
            $pre = $producto->salePrices[$i]['price'];

            try {
                if($cantidad >= $cant && $cantidad < $producto->salePrices[$i+1]['quantity']){
                    $precio = $pre;
                }
            } catch (\Throwable $th) {
                if($precio == 0){
                    $precio = $pre;
                }
            }
        }
        return $precio;
    }

}

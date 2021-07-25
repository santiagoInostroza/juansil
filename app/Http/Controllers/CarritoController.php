<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CarritoController extends Controller{

    public $eliminado;

    public function addToCart($product_id, $cantidad){
       

        $listaProductos = session('carrito');

        $producto = Product::find($product_id);

        $listaProductos[$product_id] =
            [
                'producto_id' =>$product_id,
                'name' =>$producto->name,
                'url' =>$producto->image->url,
                'cantidad' => $cantidad,
                'stock' => $producto->stock,
            ];

        session([
            'carrito' => $listaProductos
        ]);

        $precio = $this->calcularPrecioVenta($product_id, $cantidad);
        $total = $precio * $cantidad;

        session(['carrito.' . $product_id . '.precio' => $precio]);
        session(['carrito.' . $product_id . '.total' => $total]);

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
    public function calcularPrecioVenta($product_id, $miCantidad){
        $producto = Product::find($product_id);
        $precio = 0;
        $faltan = 0;
        $nivel = 0;
        $sigCantidad = 0;
        $cantidadNiveles = count($producto->salePrices);
        for ($i=0; $i < count($producto->salePrices) ; $i++) { 
            $nivel++;
            
            $cantidad = $producto->salePrices[$i]['quantity'];
            $precio = $producto->salePrices[$i]['price'];

            if($nivel< $cantidadNiveles){
                $sigCantidad =  $producto->salePrices[$i+1]['quantity'];
            }else{
                $sigCantidad = -1;
            }
                
            if($miCantidad >= $cantidad && ($miCantidad < $sigCantidad || $sigCantidad == -1 )){
                if($sigCantidad>0){
                    $faltan = $sigCantidad - $miCantidad;
                }
                session(['carrito.' . $product_id . '.cantidadNiveles' => $cantidadNiveles]);
                session(['carrito.' . $product_id . '.nivel' => $nivel]);
                session(['carrito.' . $product_id . '.faltan' => $faltan]);
                
                break;
            }
         
        }

        return $precio;
    }

}

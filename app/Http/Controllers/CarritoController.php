<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CarritoController extends Controller{

    public $eliminado;

    public function addToCart($producto_id, $cantidad, $precio, $total){
        $listaProductos = session('carrito');

        $producto = Product::find($producto_id);

        $listaProductos[$producto_id] =
            [
                'producto_id' =>$producto_id,
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
        $this->updateTotal();
    }

    public function setCantidad($producto_id, $cantidad){
       
        session('carrito')[$producto_id]['cantidad'] = $cantidad;
        $this->updateTotal();
    }

    public  function aumentarCantidad($producto_id){
        session('carrito')[$producto_id]['cantidad']++;
        $this->updateTotal();
    }
    public function disminuirCantidad($producto_id){
        session('carrito')[$producto_id]['cantidad']--;
        $this->updateTotal();
    }

}

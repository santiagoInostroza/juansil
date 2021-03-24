<?php

namespace App\Http\Livewire\Cart;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $eliminado;
    public $listaProductos = [];

    public $openCarrito = 'false';


    protected $listeners = (['addToCart', 'deleteFromCart','addToCart','productToCart','cartToProduct','updateTotal','openCarrito']);

  


    public function render()
    {
        return view('livewire.cart.index');
    }


    public function productToCart($producto_id, $cantidad, $precio, $total){
       $this->addToCart($producto_id, $cantidad, $precio, $total);
       $this->emitTo('cart.item','update',$producto_id);
    }
    public function cartToProduct($producto_id, $cantidad, $precio, $total){
       $this->addToCart($producto_id, $cantidad, $precio, $total);
       $this->emitTo('producto','render');
    }


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

    public function deleteFromCart($id)
    {
        $this->eliminado = session()->pull('carrito.' . $id, 'default');
        $this->emitTo('producto', 'checkIsAddedToCart', $id);
        $this->emitTo('cart.item','updateAll'); 
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $totalCarrito = 0;
        $totalProductos = 0;
        foreach (session('carrito') as  $value) {
            $totalCarrito +=  $value['total'];
            $totalProductos+= $value['cantidad'];

        }
        session(['totalCarrito' => $totalCarrito]);
        session(['totalProductos' => $totalProductos]);
       
    }

    public function openCarrito()
    {
        $this->openCarrito = true;
    }
}

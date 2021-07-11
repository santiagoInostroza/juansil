<?php

namespace App\Http\Livewire\Cart;

use App\Models\Product;
use Livewire\Component;
use Livewire\Livewire;

class Item extends Component
{
    public $producto;
    public $producto_id;
    public $salePrices;
    public $name;
    public $cantidad;
    public $precio;
    public $total;
    public $url;
    public $tipoPrecio =1;
    public $isPermitedUpdated;
    
    public $hasOfert;

    public $stock;
    public $msj = "";
    public $cantFaltante;

    protected $listeners = ['update','updateAll'];

    public function render()
    {
        return view('livewire.cart.item');
    }

    public function mount()
    {
        
        $this->producto_id = $this->producto['producto_id'];
        $this->update($this->producto_id);
       
    }
    public function update($id)
    {

        $this->producto = Product::find($this->producto_id);
        $this->salePrices = $this->producto->salePrices;
        $this->url = $this->producto->image->url;
        $this->stock = $this->producto->stock;
        $this->name = $this->producto->name;
        $this->hasOfert = (count($this->producto->salePrices)>1)?true:false;
        $this->cantidad = session('carrito.' . $this->producto_id . ".cantidad");
        $this->precio = session('carrito.' . $this->producto_id . ".precio");
        $this->total = session('carrito.' . $this->producto_id . ".total");
        $this->getSalePrice();
    }




    public function increment()
    {
        $this->isPermitedUpdated=true;
        if ($this->cantidad < $this->stock) {
            $this->cantidad++;
        } else {
            $this->msj = "No es posible agregar más por el momento";
        }
       
    }

    public function decrement(){
        $this->isPermitedUpdated=true;
        if ($this->cantidad > 0) {
            $this->cantidad--;
        }
    }
    public function removeItem(){
        $this->cantidad=0;
        $this->updateAll();
    }
    
    public function calcularTotal()
    {
        $this->msj = "";
        // verificar que cantidad no sea mayor al stock
        if ($this->cantidad > $this->stock) {
            $this->cantidad = $this->stock;
            $this->msj = "No es posible agregar más por el momento";
        }
        // verificar que cantidad no sea menor a 0
        if ($this->cantidad < 0) {
            $this->cantidad = 1;
        }
        
        //redondear en caso de que cantidad sea decimal
        $this->cantidad = round($this->cantidad);
        
        //OBTENER EL PRECIO DE VENTA PARA EL CLIENTE, DE ACUERDO A LA CANTIDAD DE PRODUCTOS QUE LLEVA
        $this->getSalePrice();
        
        //CALCULAR TOTAL
        $this->total = $this->cantidad * $this->precio;

        //SI CANTIDAD ES IGUAL A CERO SE MANDA A ELIMINAR
        if ($this->cantidad == 0) {
            $this->emitTo('cart.index','deleteFromCart', $this->producto_id);
            // $this->isAddedToCart = false;

        //SI CANTIDAD ES MAYOR A CERO SE MANDA A AGREGAR
        }else if ($this->cantidad > 0) {
            // $this->isAddedToCart = true;
            $this->emitTo('cart.index','addToCart', $this->producto_id, $this->cantidad, $this->precio, $this->total);
        }
        
    }

    public function updateAll(){
        $this->calcularTotal();
        $this->emitTo('precios-producto', 'mount'); 
        $this->emitTo('cart.pedido','mount'); 

    }

    public function getSalePrice(){ //OBTENER EL PRECIO DE VENTA PARA EL CLIENTE, DE ACUERDO A LA CANTIDAD DE PRODUCTOS QUE LLEVA
        $this->tipoPrecio = 1;
        $this->cantFaltante=0;
        foreach ($this->salePrices as $p) {
            if ($p->quantity > $this->cantidad) {
                $this->cantFaltante= $p->quantity- $this->cantidad;
            } else {
                $this->precio = $p->price;
                if($p->quantity>1){
                    $this->tipoPrecio = 2;
                }
            }
        }
    }


}

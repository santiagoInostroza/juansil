<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PreciosProducto extends Component
{

    public $producto;

    public $cantidad = 0;
    public $total;
    public $precio;
    public $precioUnitario = 0;
    public $hasOfert;
    public $isAddedToCart;
    public $key;
    public $permissedAddToCart=true;
    public $stock;
    public $msj = "";
    protected $listeners = ['checkIsAddedToCart', 'mount','addToCart','render'];

    public function render()
    {
        return view('livewire.precios-producto');
    }


   
    public function mount()
    {

        $this->precioUnitario =($this->producto->salePrices[0]->quantity == 1)?$this->producto->salePrices[0]->price:0; 
        $this->hasOfert = (count($this->producto->salePrices)>1)?true:false;

        $this->stock = $this->producto->stock;
        $this->checkIsAddedToCart($this->producto->id);
        if ($this->isAddedToCart) {
            $this->cantidad = session("carrito." . $this->producto->id . ".cantidad");
            $this->total = session("carrito." . $this->producto->id . ".total");
            $this->precio = session("carrito." . $this->producto->id . ".precio");
        }
    }

    public function checkIsAddedToCart($id)
    {
        if ($id == $this->producto->id) {

            if (!$this->isAddedToCart && session()->exists("carrito." . $id)) {
                $this->isAddedToCart = true;
            } else if ($this->isAddedToCart && !session()->exists("carrito." . $id)) {
                $this->isAddedToCart = false;
                $this->reset('cantidad', 'precio', 'total');
            }
        }
    }
    public function updateCantidad()
    {
        if($this->cantidad==""){
            $this->cantidad=0;
        }
    }


    public function increment()
    {
        if($this->cantidad<$this->stock){
            $this->cantidad++;
            $this->calcularTotal();
           
        }else{
            $this->msj="No tenemos más stock por el momento";
        }
    }

    public function decrement()
    {
        if ($this->cantidad > 0) {
            $this->cantidad--;
            $this->calcularTotal();
        }
    }


    public function calcularTotal()
    {
        $this->permissedAddToCart = true;
        $this->msj = "";

        if($this->cantidad>$this->stock){
            $this->cantidad=$this->stock;
            $this->msj="No tenemos más stock por el momento";
        }
        
        if($this->cantidad==""){
            $this->cantidad=0;
        }

        
        
        if ($this->cantidad == 0) {
            $this->isAddedToCart = false;
            $this->emit('deleteFromCart', $this->producto->id);
            $this->permissedAddToCart = false;
            $this->emit('updateTotal');
            //$this->checkIsAddedToCart($this->producto->id);
        }

        foreach ($this->producto->salePrices as $p) {
            if ($p->quantity > $this->cantidad) {
            } else {
                $this->precio = $p->price;
            }
        }
        
        $this->total = $this->cantidad * $this->precio;
        if ($this->isAddedToCart) {
            $this->addToCart();
        }
    }




    public function addToCart()
    {
        if ($this->permissedAddToCart) {


            //REDONDEAR POR SI ALGÚN PAYASO QUIERE INGRESAR DECIMALES
            $this->cantidad = round($this->cantidad);

            //SI ALGÚN PAYASO QUIERE INGRESAR UNA CANTIDAD NEGATIVA
            if ($this->cantidad >= 0) {


                if ($this->cantidad == 0) {
                    $this->increment();
                }

                $this->isAddedToCart = true;
                $this->emitTo('cart.index', 'productToCart', $this->producto->id, $this->cantidad, $this->precio, $this->total);
            } else {
                $this->cantidad = 0;
            }
        }else{
            $this->permissedAddToCart=true;
        }
    }
}

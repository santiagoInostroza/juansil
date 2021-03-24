<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\SalePrice;
use Livewire\Component;

class ItemVentaComponent extends Component
{

    public $item;

    public $indice;


    public $item_id;
    public $sale_id;
    public $product_id;
    public $cantidad;
    public $cantidad_por_caja;
    public $cantidad_total;
    public $precio;
    public $precio_por_caja;
    public $precio_total;

    public $lista_precios;
    public $showPrices;


    public $stock;
    public $showStock;





    public function render()
    {

        return view('livewire.item-venta-component', [
            'nombreProductos' =>  Product::pluck("name", "id")
        ]);
    }

    public function mount()
    {

        $this->fill([

            'item_id' => $this->item['item_id'],
            'sale_id' => $this->item['sale_id'],
            'product_id' => $this->item['product_id'],
            'cantidad' => $this->item['cantidad'],
            'cantidad_por_caja' => $this->item['cantidad_por_caja'],
            'cantidad_total' => $this->item['cantidad_total'],
            'precio' => $this->item['precio'],
            'precio_por_caja' => $this->item['precio_por_caja'],
            'precio_total' => $this->item['precio_total'],
        ]);
    }

    public function eliminarItem()
    {

        $this->emit('eliminarItem', $this->indice, $this->item_id);
    }

    public function calculos()
    {
        //CALCULA CANTIDAD TOTAL
        try {
            $this->cantidad_total = $this->cantidad * $this->cantidad_por_caja;
        } catch (\Throwable $th) {
            $this->cantidad_total = '';
        }

        //CALCULA TOTAL DE PRODUCTOS
        try {
            $this->precio_total = $this->cantidad_total * $this->precio;
        } catch (\Throwable $th) {
            $this->precio_total = '';
        }

        //CALCULA PRECIO CAJA A PARTIR DEL PRECIO DE UNITARIO
        try {
            $this->precio_por_caja = $this->precio * $this->cantidad_por_caja;
            $this->precio_total = $this->cantidad_total * $this->precio;
        } catch (\Throwable $th) {
            $this->precio_total = '';
        }

        $this->actualizarPadre();
    }
    public function calculaPrecio()
    {
        //CALCULA PRECIO UNITARIO A PARTIR DEL PRECIO DE CAJA
        try {
            $this->precio = round($this->precio_por_caja / $this->cantidad_por_caja);
            $this->precio_total = $this->cantidad * $this->precio_por_caja;
            $this->actualizarPadre();
        } catch (\Throwable $th) {
            $this->precio_total = '';
        }
    }

    public function calculaPrecioTotal()
    {
        //CALCULA PRECIO CAJA A PARTIR DEL PRECIO DE UNITARIO
        try {
            $this->precio_por_caja = $this->precio * $this->cantidad_por_caja;
            $this->precio_total = $this->cantidad * $this->precio_por_caja;
            $this->actualizarPadre();

           
        } catch (\Throwable $th) {
            $this->precio_total = '';
        }
        $this->showPrices();

    }

    public function actualizarPadre()
    {
        $this->emit("actualizar", $this->indice, $this->product_id, $this->cantidad, $this->cantidad_por_caja, $this->cantidad_total, $this->precio, $this->precio_por_caja, $this->precio_total);
    }


    
    public function showPrices(){
        $this->showPrices = true;
        try {
            $producto = SalePrice::where("product_id", $this->product_id)->get();
            $this->lista_precios = $producto;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function hidePrices(){
        $this->showPrices = false;
      
    }



    public function showStock(){
        $this->showStock = true;
        try {
            $stock = Product::where("id", $this->product_id)->get();
            $this->stock = $stock;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function hideStock(){
        $this->showStock = false; 
    }
}

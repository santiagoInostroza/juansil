<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ItemCompraComponent extends Component
{
    public $item;
    public $indice;

    public $item_id;
    public $product_id;
    public $cantidad;
    public $cantidad_por_caja;
    public $cantidad_total;
    public $precio;
    public $precio_por_caja;
    public $total_producto;
    public $contadorSelect =0;

    protected $rules = [
        //'product_id' => 'required',
    ];

    protected $listeners=['setProductId','calculos'];

    public function setProductId($id)
    {
        $this->product_id = $id;
        $this->actualizarPadre();
    }

    public function render()
    {
        return view('livewire.item-compra-component', [
            'nombreProductos' => Product::pluck('name', 'id'),
        ]);
    }

    public function mount()
    {

        $this->item_id = $this->item['item_id'];
        $this->product_id = $this->item['product_id'];
        $this->cantidad = $this->item['cantidad'];
        $this->cantidad_por_caja = $this->item['cantidad_por_caja'];
        $this->cantidad_total = $this->item['cantidad_total'];
        $this->precio = $this->item['precio'];
        $this->precio_por_caja = $this->item['precio_por_caja'];
        $this->total_producto = $this->item['total_producto'];
    }

    public function eliminarItemCompra()
    {

        $this->emit('eliminarItemCompra', $this->indice, $this->item_id);
    }

    public function calculos()
    {
        try {
            //CALCULA CANTIDAD TOTAL
            try {
                $this->cantidad_total = $this->cantidad * $this->cantidad_por_caja;
            } catch (\Throwable $th) {
                $this->cantidad_total = '';
            }

            //CALCULA TOTAL DE PRODUCTOS
            try {
                $this->total_producto = $this->cantidad_total * $this->precio;
            } catch (\Throwable $th) {
                $this->total_producto = '';
            }

            //CALCULA PRECIO CAJA A PARTIR DEL PRECIO DE UNITARIO
            try {
                $this->precio_por_caja = $this->precio * $this->cantidad_por_caja;
                $this->total_producto = $this->cantidad_total * $this->precio;
            } catch (\Throwable $th) {
                $this->total_producto = '';
            }

            $this->actualizarPadre();
        } catch (\Throwable $th) {
        }
    }
    public function calculaPrecio()
    {
        //CALCULA PRECIO UNITARIO A PARTIR DEL PRECIO DE CAJA
        try {
            $this->precio = round($this->precio_por_caja / $this->cantidad_por_caja);
            $this->total_producto = $this->cantidad * $this->precio_por_caja;
            $this->actualizarPadre();
        } catch (\Throwable $th) {
            $this->total_producto = '';
        }
    }

    public function calculaPrecioTotal()
    {
        //CALCULA PRECIO CAJA A PARTIR DEL PRECIO DE UNITARIO
        try {
            $this->precio_por_caja = $this->precio * $this->cantidad_por_caja;
            $this->total_producto = $this->cantidad * $this->precio_por_caja;
            $this->actualizarPadre();
        } catch (\Throwable $th) {
            $this->total_producto = '';
        }
    }

    public function actualizarPadre()
    {
        $this->emit("actualizar", $this->indice, $this->product_id, $this->cantidad, $this->cantidad_por_caja, $this->cantidad_total, $this->precio, $this->precio_por_caja, $this->total_producto);
    }



}

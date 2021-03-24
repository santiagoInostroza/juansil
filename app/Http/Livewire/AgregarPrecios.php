<?php

namespace App\Http\Livewire;

use ArrayObject;
use Livewire\Component;

class AgregarPrecios extends Component
{
    public $producto;
    public $listaProductos;
    public $precio_unitario;
    public $precio_total;
    public $cantidad;

    public $special_price;


    public function render()
    {
        return view('livewire.agregar-precios');
    }

    public function mount(){

        if(isset(request()->producto->salePrices)){
            foreach (request()->producto->salePrices as $p) {
                $this->listaProductos[$p->quantity] = [
                    'quantity'=>$p->quantity,
                    'price'=>$p->price,
                    'total_price'=>$p->total_price,
                    'special_price'=>$p->special_price,
                    'check'=>true,
                ];
            }
        }
      
    }

    public function calcularTotal()
    {
        try {
            $this->precio_total = $this->precio_unitario * $this->cantidad; 
        } catch (\Throwable $th) {}  
    }

    public function calcularPrecioUnitario()
    {
        try {
            $this->precio_unitario = round($this->precio_total / $this->cantidad,2); 
        } catch (\Throwable $th) {}
    }

    public function agregarPrecio()
    {
        $this->listaProductos[$this->cantidad] = [
            'quantity'=>$this->cantidad,
            'price'=>$this->precio_unitario,
            'total_price'=>$this->precio_total,
            'special_price'=>$this->special_price,
            'check'=>true,
        ];

        asort($this->listaProductos);
 

        $this->cantidad='';
        $this->precio_unitario='';
        $this->precio_total='';
        $this->special_price='';
       
    }

    public function eliminar($cantidad)
    {
        $this->listaProductos[$cantidad]['check']=false;
    }
    public function restaurar($cantidad)
    {
        $this->listaProductos[$cantidad]['check']=true;
    }

}

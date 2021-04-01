<?php

namespace App\Http\Livewire\Deliveries;

use Carbon\Carbon;
use Livewire\Component;

class AgregarDespacho extends Component
{

    public $name;
    public $direccion;
    public $fecha;
    public $valor_despacho;

    public $product_id;
    public $nombre_producto;
    public $cantidad;
    public $cantidad_por_caja;
    public $cantidad_total;
    public $precio;
    public $precio_por_caja;
    public $precio_total;
    public $total;
    public $payment_status = 1;
    public $delivery = 1;
    public $delivery_date;
    public $delivery_stage;
    public $tiene_comentarios;

    protected $listeners = ['setProductId'];

    public function setProductId($id,$nombre_producto)
    {
        $this->product_id = $id ;
        $this->nombre_producto = $nombre_producto ;
    }


    public function mount()
    {
        //session()->pull('despacho', 'default');
        $this->fecha = Carbon::now()->format('Y-m-d');

    }

    public function render()
    {
        return view('livewire.deliveries.agregar-despacho');
    }

    public function agregarItem()
    {

        $item = session('despacho');
        $item []= [
            'product_id' => $this->product_id,
            'nombre_producto' => $this->nombre_producto,
            'cantidad' => $this->cantidad,
            'cantidad_por_caja' => $this->cantidad_por_caja,
            'cantidad_total' => $this->cantidad_total,
            'precio' => $this->precio,
            'precio_por_caja' => $this->precio_por_caja,
            'precio_total' => $this->precio_total,
            'cantidad' => $this->cantidad,
        ] ;

        session(['despacho' => $item]);
    }

    public function closeAgregarProducto()
    {
        $this->emitUp('closeAgregarProducto');
    }
}

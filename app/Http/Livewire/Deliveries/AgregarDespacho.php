<?php

namespace App\Http\Livewire\Deliveries;

use Carbon\Carbon;
use Livewire\Component;

class AgregarDespacho extends Component
{

    public $name;
    public $direccion;
    public $fecha;

    public $producto_id;
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


    public function mount()
    {
        $this->fecha = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.deliveries.agregar-despacho');
    }


    public function dateNextDelivery()
    {
        $proxMartes = new Carbon('next tuesday');
        $proxViernes = new Carbon('next friday');

        if($proxMartes->diffInDays(Carbon::now()->toDateString())< $proxViernes->diffInDays(Carbon::now()->toDateString())){
            $fecha =  $proxMartes;
        }else{
            $fecha =  $proxViernes;
        }
       return $fecha->toDateString();
    }

    public function agregarItem()
    {
        session(['despacho' =>[

        ]]);
    }
}

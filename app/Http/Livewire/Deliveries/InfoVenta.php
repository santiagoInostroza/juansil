<?php

namespace App\Http\Livewire\Deliveries;

use App\Models\Sale;
use Livewire\Component;

class InfoVenta extends Component
{
    public $mostrar_venta=false;
    public $venta;
    public $payment_status;

    protected $listeners = ['mostrar_venta'];

    public function mount()
    {
        //$this->venta = request()->venta;

      
    }

    public function render()
    {
        return view('livewire.deliveries.info-venta');
    }
    public function mostrar_venta($id)
    {
        $this->mostrar_venta=true;
        $this->venta= Sale::find($id);
        $this->payment_status =$this->venta->payment_status;

    }

    public function pagar($id)
    {
       $this->emit("pagar",$id);
    }
}

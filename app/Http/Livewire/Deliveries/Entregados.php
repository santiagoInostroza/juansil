<?php

namespace App\Http\Livewire\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class Entregados extends Component
{
    public $fecha;

    protected $listeners = ['actualizarEntregados'];
    public function render()
    {
        $ventas = Sale::where('delivery', '1')
        ->whereDate('delivery_date', $this->fecha)
        ->where('payment_status', '=', '3')
        ->Where('delivery_stage', '1')
        ->get();

        return view('livewire.deliveries.entregados', [
            "ventas" => $ventas, 
            'ventas_entregadas' => count($ventas)
            ]);
    }

    public function actualizarEntregados($id)
    {
       $this->render();
       $this->dispatchBrowserEvent('name-updated', ['id' => $id]);
    }
}

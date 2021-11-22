<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Models\Sale;
use Livewire\Component;

class Delivered extends Component{ 
    public $fecha;

    protected $listeners = ['render'];

    public function render()
    {
        $ventas = Sale::where('delivery', '1')
        ->whereDate('delivery_date', $this->fecha)
        ->where('payment_status', '=', '3')
        ->Where('delivery_stage', '1')
        ->get();

        return view('livewire.admin.deliveries.delivered', [
            "ventas" => $ventas, 
            'ventas_entregadas' => count($ventas)
            ]);
    }

   
}

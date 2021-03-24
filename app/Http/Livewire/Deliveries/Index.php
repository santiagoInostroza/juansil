<?php

namespace App\Http\Livewire\Deliveries;

use App\Models\Sale;
use Livewire\Component;

class Index extends Component
{
    public $fecha;

    public function render()
    {
        $ventas = Sale::where('delivery','1')
        ->whereDate('delivery_date', $this->fecha)
        ->get();
        
        $prev=date("Y-m-d",strtotime($this->fecha . " -1 day"));
        $next=date("Y-m-d",strtotime($this->fecha . " +1 day"));
        $fecha=$this->fecha;



        return view('livewire.deliveries.index',compact('ventas','fecha', 'prev', 'next'));
    }

    
}

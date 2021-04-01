<?php

namespace App\Http\Livewire\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class Index extends Component
{
    public $fecha;
    public $fecha2;
    public $showAgregarDespacho = false;

    protected $listeners = ['closeAgregarProducto'];

    

    public function render(){
        
        $ventas = Sale::where('delivery','1')
        ->whereDate('delivery_date', $this->fecha)
        ->get();
        
        $prev=date("Y-m-d",strtotime($this->fecha . " -1 day"));
        $next=date("Y-m-d",strtotime($this->fecha . " +1 day"));
        
      
        $this->fecha2 =Carbon::createFromFormat('Y-m-d',  $this->fecha)->locale('es');
    
        return view('livewire.deliveries.index',compact('ventas','prev', 'next'));
    }

    public function closeAgregarProducto()
    {
        $this->showAgregarDespacho = false;
    }

    
}

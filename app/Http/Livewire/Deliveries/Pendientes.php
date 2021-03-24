<?php

namespace App\Http\Livewire\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class Pendientes extends Component
{

  public $fecha;

   protected $listeners = ['pagar','entregar'];
  
    public function render()
    {
        $ventas = Sale::where('delivery','1')
        ->whereDate('delivery_date', $this->fecha)
        ->where(function($query){
            $query->where('payment_status','!=','3')
            ->orWhere('delivery_stage','0');
        })  
        ->get();

        

        return view('livewire.deliveries.pendientes',[
            "ventas" =>  $ventas,
            'entregas_pendientes' => count($ventas)    
            ] );
    }

    public function pagar($id)
    {
      $venta = Sale::find($id); 
      $venta->payment_status=3;
      $venta->payment_date=Carbon::now()->toDateTimeString();
      $venta->payment_amount= $venta->pending_amount;
      $venta->pending_amount=0;
      $venta->save();
      $this->actualizar($id);
      

    }
    public function entregar($id)
    {
       
      $venta = Sale::find($id);
      $venta->delivery_stage=1;
      $venta->date_delivered=Carbon::now()->toDateTimeString();
      $venta->save();
      $this->actualizar($id);
      
        
    }

    public function actualizar($id)
    {
        $this->emit('actualizarEntregados',$id);
        $this->emit('mostrar_venta',$id);
    }


}

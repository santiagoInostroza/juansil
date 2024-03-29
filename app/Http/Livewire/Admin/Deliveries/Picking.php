<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Models\Sale;
use Livewire\Component;

class Picking extends Component{
    public $fecha;
    public $vistaPicking=2;
    public $diferencia;
    public $totalisimo = 0;

    public function render()
    {
        $ventas = Sale::where('delivery','1')
        ->whereDate('delivery_date', $this->fecha)
        ->get();
        $arreglo=[];
        foreach ($ventas as $venta) {
          foreach ($venta->sale_items as $item) {
            
            if(isset($arreglo[$item->product->name]) ){
                $arreglo[$item->product->name]+=$item->cantidad_total;
            }else{
                $arreglo[$item->product->name]=$item->cantidad_total;
            }
            
          }
        }
        return view('livewire.admin.deliveries.picking', compact('ventas','arreglo'));
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;

class Resumen extends Component{
    
    public $total_bodega;

    public $diferencia;
    public $total_compra;
    public $total_venta = 0;
    public $porcentaje;
    public $total_pendiente;

    public function render(){
        $sales= Sale::all();
        $total_purchases= Purchase::all()->sum('total');
        
        $products= Product::where('stock', '>',0)->get();
        foreach ($products as $product) {
            $valor = $product->purchasePrices[0]->precio;
            $this->total_bodega+= $product->stock * $valor;
        }

        
        $this->diferencia = 0;
        $this->total_compra = 0;
        $this->total_venta = 0;
        $this->porcentaje = 0;
        $this->total_pendiente = 0;


        foreach ( $sales as $venta) {
            if($venta->payment_status != 3){
              $this->total_pendiente += $venta->pending_amount;  
            }
            foreach ($venta->sale_items as $item) {
                $this->total_venta  +=  $item->precio_total;
                try {$this->total_compra += $item->cantidad_total * $item->product->purchasePrices[0]->precio;} catch (\Throwable $th) { }
            }
        }
        $this->diferencia =  $this->total_venta - $this->total_compra;  
        try {$this->porcentaje =  $this->diferencia / $this->total_venta * 100;} catch (\Throwable $th) {}


        return view('livewire.admin.resumen',compact('sales','total_purchases'))->layout('layouts.admin');
    }
}

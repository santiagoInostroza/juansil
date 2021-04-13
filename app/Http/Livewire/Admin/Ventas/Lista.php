<?php

namespace App\Http\Livewire\Admin\Ventas;

use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;

class Lista extends Component{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;

    public $diferencia;
    public $total_compra;
    public $total_venta = 0;
    public $porcentaje;
    public $total_pendiente;


    public function updatingSearch(){
        $this->resetPage();
    }


    public function render(){
        $ventas = Sale::join('customers','sales.customer_id','=','customers.id')
        ->where('customers.name','like','%'. $this->search . '%')
        ->orWhere('customers.direccion','like','%'. $this->search . '%')
        ->orWhere('customers.block','like','%'. $this->search . '%')
        ->orWhere('customers.depto','like','%'. $this->search . '%')
        ->orWhere('customers.celular','like','%'. $this->search . '%')
        ->select('sales.*')
        ->paginate(200);


        foreach ( $ventas as $venta) {
            if($venta->payment_status != 3){
              $this->total_pendiente += $venta->pending_amount;  
            }
            foreach ($venta->sale_items as $item) {
                $this->total_venta  +=  $item->precio_total;
                try {$this->total_compra += $item->cantidad_total * $item->product->purchasePrices[0]->precio;} catch (\Throwable $th) { }
            }
        }
        $this->diferencia =  $this->total_venta - $this->total_compra;  
        $this->porcentaje =  0; // $this->diferencia / $this->total_venta * 100;



        return view('livewire.admin.ventas.lista',compact('ventas'));
    }
}

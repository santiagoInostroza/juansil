<?php

namespace App\Http\Livewire\Admin\Ventas;

use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;

class Lista extends Component{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $search;
    public $sort = 'id';
    public $direction = 'desc';


    public $diferencia;
    public $total_compra;
    public $total_venta = 0;
    public $porcentaje;
    public $total_pendiente;


    public function updatingSearch(){
        $this->resetPage();
    }


    public function render(){
        if( $this->search == 'solo despachos') {
            $ventas = Sale::where('delivery',1)->paginate(100);
        }elseif($this->search == 'solo bodega'){
            $ventas = Sale::where('delivery','!=',1)->paginate(100);
        }else{
            $ventas = Sale::join('customers','sales.customer_id','=','customers.id')
            ->where('customers.name','like','%'. $this->search . '%')
            ->orWhere('customers.direccion','like','%'. $this->search . '%')
            ->orWhere('customers.block','like','%'. $this->search . '%')
            ->orWhere('customers.depto','like','%'. $this->search . '%')
            ->orWhere('customers.celular','like','%'. $this->search . '%')
            ->orWhere('sales.id','like','%'. $this->search . '%')
            ->select('sales.*')
            ->orderBy($this->sort,$this->direction)
            ->paginate(200);
        }

        $this->diferencia = 0;
        $this->total_compra = 0;
        $this->total_venta = 0;
        $this->porcentaje = 0;
        $this->total_pendiente = 0;


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
        try {$this->porcentaje =  $this->diferencia / $this->total_venta * 100;} catch (\Throwable $th) {}



        return view('livewire.admin.ventas.lista',compact('ventas'));
    }

    public function order($sort){
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                    $this->direction = 'desc';
            }
        } else {
            $this->sort=$sort;
            $this->direction = 'asc';
        }
    }
}

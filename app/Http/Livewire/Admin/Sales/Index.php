<?php

namespace App\Http\Livewire\Admin\Sales;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\SaleController;

class Index extends Component{

    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public $month;

    public $open_show;
    public $selected_sale;

    protected $listeners = ['render'];

    public function mount(){

        $this->month = Carbon::now()->locale('es')->timezone('America/Santiago');
        $this->month = $this->month->format('Y-m');

        if(isset($_GET['id'])){

            $this->open_show($_GET['id']);
        }
        
    }

    public function render(){

        $month =Carbon::createFromFormat('Y-m', $this->month)->locale('es')->format('m');
        $year =Carbon::createFromFormat('Y-m', $this->month)->locale('es')->format('Y');
        
        $sales =  Sale::join('customers','sales.customer_id','=','customers.id')
        ->whereMonth('sales.date', $month)->whereYear('sales.date', $year)
        ->where('sales.id','like','%'. $this->search . '%')
        ->orWhere('customers.name','like','%'. $this->search . '%')
        ->orWhere('customers.direccion','like','%'. $this->search . '%')
        ->orWhere('customers.block','like','%'. $this->search . '%')
        ->orWhere('customers.depto','like','%'. $this->search . '%')
        ->orWhere('customers.celular','like','%'. $this->search . '%')
        ->orWhere('sales.total','like','%'. $this->search . '%')
        ->orWhere('sales.date','like','%'. $this->search . '%')

        ->with('movement_sales.purchase_price')
        
        ->select('sales.*')
        ->orderBy($this->sort,$this->direction)
        ->paginate(50);
        return view('livewire.admin.sales.index',compact('sales'));
    }

    public function order($sort){
        if ($this->sort == $sort) {
           
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
            
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        
      
    }

    public function open_show(Sale $sale){
        $this->open_show = true;
        $this->selected_sale = $sale;

        
    }
    public function deleteSale(Sale $sale){
        $saleController = new SaleController();
        $saleController->deleteSale($sale);
        $this->dispatchBrowserEvent('alerta', [
                'msj' =>  "Pedido " . $sale->id ." eliminado !!. Total ". number_format($sale->total,0,',','.'),
                'icon' => 'success',
                'title' => "Pedido Eliminado",
        ]); 
    }

    public function editSale(Sale $sale){
        $saleController = new SaleController();
        $saleController->editSale($sale);
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Pedido " . $sale->id ." editado !!. Total ". number_format($sale->total,0,',','.'),
            'icon' => 'success',
            'title' => "Pedido Editado",
        ]); 
        
    }

    public function generarBoleta(Sale $sale){
        $sale->boleta = 1;
        $sale->fecha_boleta =Carbon::now();
        $sale->user_boleta = Auth::id();
        $sale->save();
    }

    public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }
    public static function fechaHora($fecha){
        return Carbon::createFromFormat('Y-m-d H:i:s', $fecha)->locale('es')->timezone('America/Santiago');
    }

    

    
}

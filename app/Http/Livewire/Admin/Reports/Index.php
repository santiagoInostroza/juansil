<?php

namespace App\Http\Livewire\Admin\Reports;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use App\Models\Purchase;

class Index extends Component{

    public $showSales = true;
    public $openShowSale = false;
    public $month;
    public $order_by = 'id';
    public $direccion = 'asc';

    public function mount(){
        $this->month = Carbon::now()->locale('es')->timezone('America/Santiago');
        $this->month = $this->month->format('Y-m');
    }

    public function render(){

        $month =Carbon::createFromFormat('Y-m', $this->month)->locale('es')->format('m');
        $year =Carbon::createFromFormat('Y-m', $this->month)->locale('es')->format('Y');

        $sales = Sale::with('customer')->whereMonth('date', $month)->whereYear('date', $year)->orderBy($this->order_by,$this->direccion)->get();

        return view('livewire.admin.reports.index',compact('sales'));
    }

    public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }


    public function nextMonth(){
        $this->month =  Carbon::createFromFormat('Y-m', $this->month)->locale('es')->addMonth()->format('Y-m');
    }

    public function lastMonth(){
        $this->month =  Carbon::createFromFormat('Y-m', $this->month)->locale('es')->subMonth()->format('Y-m');
        
    }

    public $sale_selected;

    public $product_id;
    public $cantidad;
    public $cantidad_por_caja;
    public $cantidad_total;
    public $precio;
    public $precio_por_caja;
    public $precio_total;
    public $costo;

    public function showSale(Sale $sale){
        $this->sale_selected= $sale;
        $this->openShowSale = true;    
    }
}

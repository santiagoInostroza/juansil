<?php

namespace App\Http\Livewire\Admin\Reports;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class Index extends Component{

    public $showSales = true;
    public $month;

    public function mount(){
        $this->month = Carbon::now()->locale('es')->timezone('America/Santiago');
        $this->month = $this->month->format('Y-m');
    }

    public function render(){

        $month =Carbon::createFromFormat('Y-m', $this->month)->locale('es')->format('m');
        $year =Carbon::createFromFormat('Y-m', $this->month)->locale('es')->format('Y');

        $sales = Sale::whereMonth('date', $month)->whereYear('date', $year)->get();

        return view('livewire.admin.reports.index',compact('sales'));
    }

    public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }

    public function seleccionaMes(){
        
    }

    public function nextMonth(){
        $this->month =  Carbon::createFromFormat('Y-m', $this->month)->locale('es')->addMonth()->format('Y-m');
    }

    public function lastMonth(){
        $this->month =  Carbon::createFromFormat('Y-m', $this->month)->locale('es')->subMonth()->format('Y-m');
        
    }
}

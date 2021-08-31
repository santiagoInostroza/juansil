<?php

namespace App\Http\Livewire\Admin\Home;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\PurchasePrice;

class Totals extends Component{

    public $month;

    public function mount(){
        $this->month = Carbon::now()->locale('es')->timezone('America/Santiago');
        $this->month = $this->month->format('Y-m');
    }


    
    public function render(){

        $month =Carbon::createFromFormat('Y-m', $this->month)->locale('es')->format('m');
        $year =Carbon::createFromFormat('Y-m', $this->month)->locale('es')->format('Y');


        $totalSales = Sale::whereMonth('date', $month)->whereYear('date', $year)->sum('total');
        $totalCost = Sale::whereMonth('date', $month)->whereYear('date', $year)->sum('total_cost');
        $diferencia = $totalSales - $totalCost;
        try {
            $porcentaje = $diferencia / $totalSales * 100;
        } catch (\Throwable $th) {
            $porcentaje = 0;
        }
        

        $totalPurchases = Purchase::whereMonth('fecha', $month)->whereYear('fecha', $year)->sum('total');

        $inventario = PurchasePrice::sum(PurchasePrice::raw('stock * precio'));
        $inventario2 = PurchasePrice::whereMonth('fecha', $month)->whereYear('fecha', $year)->sum(PurchasePrice::raw('stock * precio'));

        return view('livewire.admin.home.totals',compact('totalSales','totalCost','diferencia','porcentaje','totalPurchases','inventario','inventario2'));
    }

    public function nextMonth(){
        $this->month =  Carbon::createFromFormat('Y-m', $this->month)->locale('es')->addMonth()->format('Y-m');
    }

    public function lastMonth(){
        $this->month =  Carbon::createFromFormat('Y-m', $this->month)->locale('es')->subMonth()->format('Y-m');
        
    }

    public function seleccionaMes(){
        
    }
}

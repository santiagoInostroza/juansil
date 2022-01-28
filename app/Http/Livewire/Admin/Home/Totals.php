<?php

namespace App\Http\Livewire\Admin\Home;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\PurchasePrice;

class Totals extends Component{

    public $month;
    public $year;
    public $period;

    public function mount(){
        $this->period =  $this->year.'-'.$this->month;
    }
    
    public function render(){       
        $totalSales = Sale::whereMonth('date', $this->month)->whereYear('date', $this->year)->sum('total');
        $totalCost = Sale::whereMonth('date', $this->month)->whereYear('date', $this->year)->sum('total_cost');
        $diferencia = $totalSales - $totalCost;
        try {
            $porcentaje = $diferencia / $totalSales * 100;
        } catch (\Throwable $th) {
            $porcentaje = 0;
        }
        

        $totalPurchases = Purchase::whereMonth('fecha', $this->month)->whereYear('fecha', $this->year)->sum('total');

        $inventario = PurchasePrice::sum(PurchasePrice::raw('stock * precio'));
        $inventario2 = PurchasePrice::whereMonth('fecha', $this->month)->whereYear('fecha', $this->year)->sum(PurchasePrice::raw('stock * precio'));

        return view('livewire.admin.home.totals',compact('totalSales','totalCost','diferencia','porcentaje','totalPurchases','inventario','inventario2'));
    }

    public function nextMonth(){
        $this->period =  Carbon::createFromFormat('Y-m', $this->period)->locale('es')->addMonth()->format('Y-m');
    }

    public function lastMonth(){
        $this->period =  Carbon::createFromFormat('Y-m', $this->period)->locale('es')->subMonth()->format('Y-m');
        
    }
}

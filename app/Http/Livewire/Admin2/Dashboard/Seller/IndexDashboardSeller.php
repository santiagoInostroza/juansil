<?php

namespace App\Http\Livewire\Admin2\Dashboard\Seller;

use Livewire\Component;

class IndexDashboardSeller extends Component{
    public $user;
    public $month;
    public $year;

    public $salesOfTheYearCompleted;
    public $salesOfTheMonth;
    public $salesOfTheMonthCompleted;

    public $salesOfToday;

    public $salesLessThan30k;
    public $salesgreaterThan30k;
    public $salesgreaterThan50k;

    public $totalToPay;
    public $totalSales;
    public $totalAmountOfSales;

    public function render(){
        
        $this->salesOfTheYearCompleted = $this->user->salesOfTheYearCompleted();
        $this->salesOfToday = $this->user->salesOfToday();


        $this->salesOfTheMonth = $this->user->salesOfTheMonth();
        $this->salesOfTheMonthCompleted =  $this->user->salesOfTheMonthCompleted($this->month,$this->year);

        $this->salesLessThan30k = ($this->salesOfTheMonthCompleted) ? $this->salesOfTheMonthCompleted->where('total','<',30000)->count() : 0;
        $this->salesgreaterThan30k = ($this->salesOfTheMonthCompleted) ? $this->salesOfTheMonthCompleted->where('total','>',30000)->where('total','<',50000)->count() : 0;
        $this->salesgreaterThan50k = ($this->salesOfTheMonthCompleted) ? $this->salesOfTheMonthCompleted->where('total','>',50000)->count() : 0;

        $this->totalToPay = ($this->salesLessThan30k * 400) + ($this->salesgreaterThan30k * 600) + ($this->salesgreaterThan50k * 800);
        $this->totalSales = ($this->salesOfTheMonthCompleted)? $this->salesOfTheMonthCompleted->count() : 0;
        $this->totalAmountOfSales = ($this->salesOfTheMonthCompleted)? $this->salesOfTheMonthCompleted->sum('total') : 0;
        

        return view('livewire.admin2.dashboard.seller.index-dashboard-seller');
    }
}

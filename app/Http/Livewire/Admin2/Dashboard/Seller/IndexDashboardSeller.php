<?php

namespace App\Http\Livewire\Admin2\Dashboard\Seller;

use Livewire\Component;

class IndexDashboardSeller extends Component{
    public $month;
    public $salesOfTheYearCompleted;
    public $salesOfTheMonthCompleted;
    public $salesOfToday;

    public $salesLessThan30k;
    public $salesgreaterThan30k;
    public $salesgreaterThan50k;

    public $totalToPay;

    public function mount(){
        $this->month = 3;
        
    }

    public function render(){
        
        $this->salesOfTheYearCompleted = auth()->user()->salesOfTheYearCompleted();
        $this->salesOfToday = auth()->user()->salesOfToday();


        $this->salesOfTheMonthCompleted = auth()->user()->salesOfTheMonthCompleted($this->month);
        $this->salesLessThan30k =  $this->salesOfTheMonthCompleted->where('total','<',30000)->count();
        $this->salesgreaterThan30k =  $this->salesOfTheMonthCompleted->where('total','>=',30000)->where('total','<',50000)->count();
        $this->salesgreaterThan50k =  $this->salesOfTheMonthCompleted->where('total','>=',50000)->count();

        $this->totalToPay = ($this->salesLessThan30k * 400) + ($this->salesgreaterThan30k * 600) + ($this->salesgreaterThan50k * 800);
        

        return view('livewire.admin2.dashboard.seller.index-dashboard-seller',[
            'salesOfTheYearCompleted' => auth()->user()->salesOfTheYearCompleted(),
            'salesOfTheMonthCompleted' => auth()->user()->salesOfTheMonthCompleted($this->month),
            'salesOfToday' => auth()->user()->salesOfToday(),
        ]);
    }
}

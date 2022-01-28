<?php

namespace App\Http\Livewire\Admin\Home;

use Carbon\Carbon;
use Livewire\Component;

class Index extends Component{

    public $period;
    public $month;
    public $year;
    
    public function mount(){
        $this->period = Carbon::now()->locale('es')->timezone('America/Santiago');
        $this->month =$this->period->format('m'); 
        $this->year =$this->period->format('Y');
        
    }
    public function render(){
      
         return view('livewire.admin.home.index');
    }
}

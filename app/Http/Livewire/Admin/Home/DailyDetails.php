<?php

namespace App\Http\Livewire\Admin\Home;

use App\Models\Sale;
use Livewire\Component;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DailyDetails extends Component{

    public $month;
    public $year;

    public $fecha_inicio;
    public $fecha_termino;

    public function mount(){
        $this->fecha_inicio = date($this->year.'-'.$this->month.'-1');
        $this->fecha_termino = date($this->year.'-'.$this->month.'-t') ;
    }
    
    public function render(){
        
        $period = new CarbonPeriod( $this->fecha_inicio, $this->fecha_termino);  
        
        $salesArray= [];
        foreach ($period as $key => $value) {
            $date = Str::limit($value, 10, ''); //2020-12-12
            // $salesArray[$date]= Sale::whereYear('date','=',date('Y',strtotime($value)))
            // ->whereMonth('date','=',date('m',strtotime($value)))
            // ->whereDay('date','=',date('d',strtotime($value)))
            // ->get();
            $salesArray[$date]= Sale::whereDate('date','like','%'.$date.'%')->get();
        }

        // $sales = Sale::whereMonth('date','=',$this->month)->whereYear('date','=',$this->year)->get();


        return view('livewire.admin.home.daily-details',compact('period','salesArray'));
    }
}

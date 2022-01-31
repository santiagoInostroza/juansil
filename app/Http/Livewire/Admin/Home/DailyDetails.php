<?php

namespace App\Http\Livewire\Admin\Home;

use App\Models\Sale;
use Livewire\Component;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DailyDetails extends Component{

    public $sales;
    public $month;
    public $year;

    public $fecha_inicio;
    public $fecha_termino;


    public function mount(){
        $this->fecha_inicio = date($this->year.'-'.$this->month.'-1');
        $this->fecha_termino = date($this->year.'-'.$this->month.'-t');
    }
    
    public function render(){
        
        $period = new CarbonPeriod( $this->fecha_inicio, $this->fecha_termino);  
        
        $totalMonth = 0;
        $allSales = Sale::where(function($query){
           $query->whereYear('delivery_date','=',$this->year)->whereMonth('delivery_date','=',$this->month);
        })
        ->orWhere(function($query){
            $query->where('delivery_date','=',null)->whereYear('date','=',$this->year)->whereMonth('date','=',$this->month);
        })->get()
        ->map(function($query){
            if ($query->delivery_date === null) {
                $query->new_date = $query->date;
            }else{
                $query->new_date = $query->delivery_date;
            }
            return $query;
        });


       
        $this->sales['totalMonth']= $allSales->sum('total');
        $this->sales['maxMonth']= $allSales->max('total');
        
        foreach ($period as $dateTime) {
            $date = $dateTime->format('Y-m-d');
            $sales= $allSales->where('new_date', '=', $date );
           
            // VENTAS TOTALES
            $this->sales[$date]= $sales;
            $this->sales[$date]['total']= $sales->sum('total');
            $this->sales[$date]['sales_percentage']=($this->sales[$date]['total']>0) ? $this->sales[$date]['total'] / $this->sales['maxMonth'] * 100 : 0;

            $this->sales[$date]['pending']= $sales->where('payment_status',1);
            $this->sales[$date]['partial']= $sales->where('payment_status',2);
            $this->sales[$date]['paid_out']= $sales->where('payment_status',3);





           
        }
        
        
       



        return view('livewire.admin.home.daily-details',compact('period','allSales'));
    }
}

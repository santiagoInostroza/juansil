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


        // TODAS LAS VENTAS DEL MES
        $this->sales['all']= $allSales->groupBy('new_date');


        $maxValue = 0;
        foreach ($this->sales['all'] as $key => $value) {
            $totalDay = 0;
            foreach ($value as $key2 => $value2) {
                $totalDay +=  $value2->total;
            }
            if ($totalDay > $maxValue) {
                $maxValue= $totalDay;
            }
        }
        $this->sales['maxDay'] = $maxValue;
        $this->sales['totalMonth']= $allSales->sum('total');
        

        // $this->sales['maxDay']= $this->sales['all']->max(['new_date'],'total');
        foreach ($period as $dateTime) {
            $date = $dateTime->format('Y-m-d');
            $sales= $allSales->where('new_date', '=', $date );
           
            

            // TODAS LAS VENTAS DEL DIA
            $this->sales[$date]= $sales;
            $this->sales[$date]['total']= $sales->sum('total');
            $this->sales[$date]['sales_percentage']=($this->sales[$date]['total']>0) ? $this->sales[$date]['total'] / $this->sales['maxDay'] * 100 : 0;
            // $this->sales[$date]['sales_percentage']= 0;

            // TODAS LASA VENTAS PENDIENTES
            $this->sales[$date]['pending']= $sales->where('payment_status',1);

            // TODAS LAS VENTAS PARCIALMENTE ABONADAS
            $this->sales[$date]['partial']= $sales->where('payment_status',2);

            // TODAS LAS VENTAS
            $this->sales[$date]['paid_out']= $sales->where('payment_status',3);





           
        }
        
        
       



        return view('livewire.admin.home.daily-details',compact('period','allSales'));
    }
}

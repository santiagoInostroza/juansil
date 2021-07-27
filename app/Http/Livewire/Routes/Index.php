<?php

namespace App\Http\Livewire\Routes;

use Carbon\Carbon;
use App\Models\Comuna;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\Calendario;
use Illuminate\Support\Facades\Auth;

class Index extends Component{
    public $mes1 =0;
    public $mes2;
    public $fecha_inicio;
    public $fecha_termino;
    public $tipoBusqueda;
    public $por_mes;
    public $por_rango1;
    public $por_rango2;
    public $modal=false;

    public function mount(){



        $this->por_mes = date('Y-m');
        $this->tipoBusqueda = 1;
        $this->fecha_inicio = date("Y-m-1");
        $this->fecha_termino = date("Y-m-t") ;

    }


    public function render(){


        $period = new CarbonPeriod( $this->fecha_inicio, $this->fecha_termino);     
        $comunas = Comuna::all();
        $calendario = Calendario::all();

        return view('livewire.routes.index',compact('comunas','period','calendario'));
    }

    public function prueba(){
        $this->tipoBusqueda = 1;
    }

    public function seleccionaMes(){
        $this->fecha_inicio = $this->por_mes.'-01';
        $this->fecha_termino = $this->por_mes. date('-t',strtotime(date($this->por_mes)));
    }

    public function selecciona_rango1(){
        $this->fecha_inicio = $this->por_rango1;
        if(strtotime($this->por_rango1)>=strtotime( $this->fecha_termino)){
            $this->fecha_termino = $this->por_rango1;
            $this->por_rango2 = $this->fecha_termino;
        }
       
    }

    public function selecciona_rango2(){
        $this->fecha_termino = $this->por_rango2;
        if(strtotime($this->por_rango2)<=strtotime( $this->fecha_inicio)){
            $this->fecha_inicio = $this->por_rango2;
            $this->por_rango1 = $this->fecha_inicio;
        }
       
    }
    public function noAgendable($dia,$mes,$anio,$comentario){
       $calendario =  Calendario::create([
            'fecha'=> date('Y-m-d',strtotime($anio.'-'.$mes.'-'.$dia)),
            'comentario' => $comentario,
            'agendable' => 0,
            'user_created' => Auth::id(),
        ]);

        if($calendario){
            return true;
        }else{
            return false;
        }
    }
    public function agendable($calendario_id){
       $calendario =  Calendario::find($calendario_id);
       ;
        if($calendario->delete()){
            return true;
        }else{
            return false;
        }
    }
}


<?php

namespace App\Http\Livewire\Routes;

use App\Models\Comuna;
use Livewire\Component;

class Sectors extends Component{
    public $modal = false;

    public $comunas;
    public $comuna_seleccionada;

    public $tiene_reparto;
    public $valor_despacho;
    public $sector;
    public $dias_rebajados;
    public $valor_rebajado;

    public function render(){

        $this->comunas = Comuna::all();
        return view('livewire.routes.sectors');
    }

    public function openModal($id){
        $this->comuna_seleccionada = $this->comunas->find($id);
        $this->tiene_reparto = $this->comuna_seleccionada->tiene_reparto;
        $this->valor_despacho = $this->comuna_seleccionada->valor_despacho;
        $this->sector = $this->comuna_seleccionada->sector;
        $this->dias_rebajados = explode(',',$this->comuna_seleccionada->dias_rebajados);
        $this->valor_rebajado = $this->comuna_seleccionada->valor_rebajado;
        $this->modal = true;

    }



    public function save(){

       $this->comuna_seleccionada->valor_despacho= $this->valor_despacho;
       $this->comuna_seleccionada->sector= $this->sector;
       $this->comuna_seleccionada->dias_rebajados= implode(",",$this->dias_rebajados);
       $this->comuna_seleccionada->valor_rebajado= $this->valor_rebajado;
       $this->comuna_seleccionada->tiene_reparto= $this->tiene_reparto;
       $this->comuna_seleccionada->save();
       $this->modal = false;
        
    }
}

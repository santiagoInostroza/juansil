<?php

namespace App\Http\Livewire\Input;

use Livewire\Component;

class Celular extends Component
{
    public $celular;
    public $celularValido=0;
    public $msjErrorCelular  = "";
    
    public function render()
    {
        return view('livewire.input.celular');
    }

    
    public function validarCelular(){
        $this->celularValido=0;
        $this->celular = str_replace(' ', '', $this->celular);        
        if(substr($this->celular, 0,4) == "+569"){
            $this->celular = substr($this->celular, 4);
        }
        if (strlen($this->celular) >= 8 ){
            try {
                $this->celular*1;
                $this->celular =  "+56 9 " . substr($this->celular, -8,4) . " " . substr($this->celular, -4);
                $this->msjErrorCelular  = "";
                $this->celularValido=1;
            } catch (\Throwable $th) {
                $this->msjErrorCelular  = "Debes ingresar solo números";
            }
        }else{
            $this->msjErrorCelular  = "Debes ingresar un numero valido";
        }

    }

}

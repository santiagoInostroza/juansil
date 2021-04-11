<?php

namespace App\Http\Livewire\Select;

use Livewire\Component;
use App\Models\Customer;

class Clientes extends Component{
    public $indice;
    public $query = "";
    public $customer_id;
    public $nombreCliente;
    public $showList = false;
    public $showCreateCustomer = false;
    public $clientes = "";
    public $index =0;


    public $agregar_cliente = false;

    public function mount(){

       if($this->customer_id>0) {
           $customer = Customer::find($this->customer_id);
           $this->query = $customer->name;
       };

       if(request()->agregar_cliente) {
           $this->agregar_cliente = true;
       };

       
    }


    protected $listeners=['setCustomerId','showCreateCustomer'];



    public function render(){
        $clientes = Customer::where("name","like", "%". $this->query ."%")->orWhere("direccion","like", "%". $this->query ."%")->get();
        $this->clientes = $clientes;
        return view('livewire.select.clientes',compact('clientes'));
    }
    
    
    public function marcarSeleccion($id){
        $this->index = $id;
    }
  
    public function setCustomerId($id, $nombreCliente){  
        $this->customer_id = $id;
        $this->query = $nombreCliente;
        $this->showList= false;
        $this->emitUp('setCustomerId',$this->customer_id,$this->query);
    }
    
    public function incrementIndex(){
        $this->showList=true;
        if (count($this->clientes) == 0) {
            $this->index=1;
        }else{            
            $this->index++;
            if( $this->index > count($this->clientes) ){
                $this->index = 1;
            }
        }
    }

    public function decrementIndex(){
        $this->showList=true;
        if (count($this->clientes) == 0) {
            $this->index=1;
        }else{ 
            $this->index--;
            if( $this->index <= 0 ){
                $this->index = count($this->clientes);
            } 
        }       
    }

    public function seleccionarOpcion(){   
        if (count($this->clientes) == 0 && $this->index==1) {
           
            $this->showCreateCustomer = true;
        } else {
            $this->customer_id = $this->customer[$this->index-1]['id'];
            $this->query = $this->clientes[$this->index-1]['name'];
            $this->showList= false;
            $this->emitUp('setCustomerId',$this->customer_id);
        }
        
       
    }

    public function showCreateCustomer(){
        $this->showCreateCustomer = true;
    }

}

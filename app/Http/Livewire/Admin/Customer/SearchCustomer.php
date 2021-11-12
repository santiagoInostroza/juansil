<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Comuna;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Str;

class SearchCustomer extends Component{
    public $search;
    public $customer_id;
    public $selected_customer;

    public $open_search=true;
    public $open_list = false;
    public $open_data_customer = false;
    public $open_new_customer = false;

    public $showDataCustomer = true;

    // VARIABLES DE CREAR CLIENTE

    public $showCreateCustomer = false;

    public $name;
    public $telefono;
    public $celular;
    public $direccion;
    public $numero;
    public $latitud;
    public $longitud;
    public $place_id;
    public $comuna;
    public $block;
    public $depto;
    public $comentario;

    public $index = 0;

    
    
    public $celularValido;
    public $msjErrorCelular;

    protected $listeners = [
        'setSearch',
    ];


    public function render(){

        $customers = Customer::where('name','like', '%' . $this->search . '%')
        ->orWhere('direccion','like', '%' . $this->search . '%')
        ->get();
        return view('livewire.admin.customer.search-customer',compact('customers'));
    }

    public function setSearch($nombre,$id){
        $this->search = $nombre;
        $this->customer_id = $id; 
        $this->selected_customer = Customer::find($id);
        $this->showList = false;
        $this->setCustomer_id();
    }

    public function setCustomer_id(){
        $this->emitUp('setCustomerId',$this->customer_id);
    }

    protected $rules = [
        'name' => 'required|min:3',
        'direccion' => 'required',
        'numero' => 'required',
        'comuna' => 'required',
        'latitud' => 'required',
        'longitud' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Ingresa un nombre.',
        'name.min' => 'Nombre muy corto.',
        'direccion.required' => 'Ingresa dirección',
        'numero.numeric' => 'Debes ingresar numeración de dirección. ',
        'comuna.required' => 'Revisa la direccion, no se ha ingresado la comuna.',
    ];

    public function save_customer(){

        $this->validate();

        $cliente = new Customer();
        $cliente->name = $this->name;
        $cliente->slug = Str::slug($this->name);
        $cliente->telefono = $this->telefono;
        $cliente->celular = $this->celular;
        $cliente->direccion = $this->direccion;
        $cliente->block = $this->block;
        $cliente->depto = $this->depto;
        $cliente->comuna = $this->comuna;
        // $cliente->place_id = $this->place_id;
        $cliente->latitud = $this->latitud;
        $cliente->longitud = $this->longitud;
        $cliente->comentario = $this->comentario;
        $cliente->save();
        $this->open_search = true;
        $this->open_new_customer = false;
        $this->search = $this->name;
        $this->customer_id = $cliente->id;
        $this->selected_customer = $cliente;
        $this->open_data_customer = true;
        $this->setCustomer_id();
        $this->dispatchBrowserEvent('alerta', [
            'msj' => "Cliente '" . $this->name . "' creado con exito!",
            'icon' => 'success',
            'title' => 'Cliente creado !!'
        ]); 

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

<?php

namespace App\Http\Livewire\Cart;

use App\Models\Calendario;
use Exception;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Comuna;
use Livewire\Component;
use App\Models\Customer;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;

class Pedido extends Component
{


    public $email;
    public $direccion;
    public $comuna;
    public $name;
    public $celular;
    public $block;
    public $depto;
    public $latitud;
    public $longitud;
    public $comentario ="";
    
    public $date;
    
    public $open_level_1 = true;
    public $is_ok_level_1 = false;
    
    public $open_level_2 = false;
    public $is_ok_level_2 = false;
    
    public $open_level_3 = false;
    public $is_ok_level_3 = false;

    public $open_level_4 = false;

    public $modal = false;
    public $comunas_disponibles;

   
    public $totalDespacho = 0;
    public $fechaDespacho;
    public $direccionValida=0;
    public $celularValido=1;
    public $msjErrorCelular="";
    public $comunaDespacho; 
    public $totalCarrito;

    public $fechasDespacho=[];

    protected $listeners = [
        'validarDireccion','render','mount'
    ];
    protected $rules = [
        'email' => 'required|email',
        'direccion' => 'required',
        'comuna' => 'required',
        'name' => 'required',
        'celular' => 'required'
    ];
    protected $messages = [
        'email.required' => 'El campo email no puede estar vacio.',
        'email.email' => 'El campo debe contener una direccion de email valida.',
        'direccion.required' => 'El campo direccion no puede estar vacio.',
        'comuna.required' => 'El campo comuna no puede estar vacio.',
        'name.required' => 'El campo contacto no puede estar vacio.',
        'celular.required' => 'El campo celular no puede estar vacio.',
    ];
    
    public function mount(){
        // $this->date = Carbon::now()->locale('es')->timezone('America/Santiago');
 
        // VERIFICAR SI PEDIDO ESTA CONFIRMADO
        if(session()->has('cliente.open_level_1')){
            $this->open_level_1= session('cliente.open_level_1');
        }
        if(session()->has('cliente.is_ok_level_1')){
            $this->is_ok_level_1= session('cliente.is_ok_level_1');
        }

        // VERIFICAR SI DATOS DE DESPACHO ESTA VALIDADOS
        if(session()->has('cliente.open_level_2')){
            $this->open_level_2= session('cliente.open_level_2');
        }
        if(session()->has('cliente.is_ok_level_2')){
            $this->is_ok_level_2= session('cliente.is_ok_level_2');
        }

        // VERIFICAR SI FECHA DE DESPACHO ESTA VALIDADOS
        if(session()->has('cliente.open_level_3')){
            $this->open_level_3= session('cliente.open_level_3');
        }
        if(session()->has('cliente.is_ok_level_3')){
            $this->is_ok_level_3= session('cliente.is_ok_level_3');
        }

         // VERIFICAR SI SE MUESTRA RESUMEN
         if(session()->has('cliente.open_level_4')){
            $this->open_level_4= session('cliente.open_level_4');
        }

        // VERIFICAR SI EXISTE TOTAL DE DESPACHO 
        if(session()->has('cliente.totalDespacho')){
            $this->totalDespacho= session('cliente.totalDespacho');
        }

      

        // VERIFICAR SI EXISTE FECHA DE DESPACHO 
        if(session()->has('cliente.fechaDespacho')){
            $this->fechaDespacho= session('cliente.fechaDespacho');
        }

        // VERIFICAR SI EXISTE DIRECCION VALIDA
        if(session()->has('cliente.direccionValida')){
            $this->direccionValida= session('cliente.direccionValida');
        }

        if( session()->has('cliente.datos')  ){
            $this->name = session('cliente.datos.name');
            $this->comuna = session('cliente.datos.comuna');
            $this->direccion = session('cliente.datos.direccion');
            $this->celular = session('cliente.datos.celular');
            $this->block = session('cliente.datos.block');
            $this->depto = session('cliente.datos.depto');
            $this->latitud = session('cliente.datos.latitud');
            $this->longitud = session('cliente.datos.longitud');
            $this->comentario = session('cliente.datos.comentario');
            $this->email= session('cliente.datos.email');
        }
       if(session()->has('totalCarrito')){
           $this->totalCarrito= session('totalCarrito');
        }
        if(session()->has('cliente.comunaDespacho')){
             $this->comunaDespacho= session('cliente.comunaDespacho');
        }


        if($this->comuna){
            $this->cargarFechasDespacho();
        }

     }
     

    
    
     public function render(){
        // $this->date = Carbon::now()->locale('es');
        return view('livewire.cart.pedido');
    }


    // NIVEL 1 REVISAR PEDIDO
    public function validateLevel1(){
        $this->open_level_1 = false;
        session(['cliente.open_level_1' => $this->open_level_1]);

        $this->is_ok_level_1 = true;
        session(['cliente.is_ok_level_1' => $this->is_ok_level_1]);

        $this->abrirNivelPendiente();      
    }
    public function editLevel1(){

        $this->open_level_2 = false;
        session(['cliente.open_level_2' => $this->open_level_2]);
        $this->open_level_3 = false;
        session(['cliente.open_level_3' => $this->open_level_3]);
        $this->open_level_4 = false;
        session(['cliente.open_level_4' => $this->open_level_4]);


        $this->open_level_1 = true;
        session(['cliente.open_level_1' => $this->open_level_1]);
      
       
    }



    // NIVEL 2 DATOS DE DESPACHO
    public function validarDireccion($newDireccion, $comuna, $lat, $lng ,$numero){
        if($comuna){
            $direccion = Customer::where('longitud', $lng) ->where('latitud',$lat) ->first();

            $this->name = "";
            $this->celular = "";
            $this->block ="";
            $this->depto = "";
            $this->comentario = "";   
            $this->direccion = $newDireccion;
            $this->comuna = $comuna;

            try {
                $numero *1;
                if ($direccion ){
                    $this->name = $direccion->name;
                    $this->celular = $direccion->celular;
                    $this->block = $direccion->block;
                    $this->depto = $direccion->depto;
                    $this->comentario = $direccion->comentario; 
                    $this->email = $direccion->email; 
                }

                $this->comunaDespacho = Comuna::where('name' ,Str::upper($comuna))->where('tiene_reparto','1')->first();
                
                if($this->comunaDespacho){
                    $this->direccionValida=1;
                    $this->latitud = $lat;
                    $this->longitud = $lng;
                    $this->cargarFechasDespacho();  
                }else{
                    $this->direccionValida=4; 
                    $this->is_ok_level_2 = false;

                    $this->fechaDespacho ="";
                    $this->is_ok_level_3 = false;
                    $this->dispatchBrowserEvent('alerta', [
                        'icon' => 'warning',
                        'msj' => "Por el momento no tenemos reparto para " . $comuna,
                    ]); 
                }   

            } catch (\Throwable $th) {
                $this->direccionValida=3; 
                $this->is_ok_level_2 = false;

                $this->fechaDespacho ="";
                $this->is_ok_level_3 = false;
                
                
            }

            session(['cliente.datos.name' => $this->name]);
            session(['cliente.datos.email' => $this->email]);
            session(['cliente.datos.celular' => $this->celular]);
            session(['cliente.datos.block' => $this->block]);
            session(['cliente.datos.depto' => $this->depto]);
            session(['cliente.datos.comentario' => $this->comentario]);
            session(['cliente.datos.direccion' => $this->direccion]);
            session(['cliente.datos.comuna' => $this->comuna]);
            session(['cliente.datos.latitud' => $this->latitud]);
            session(['cliente.datos.longitud' => $this->longitud]);
            session(['cliente.is_ok_level_2' => $this->is_ok_level_2]);
            session(['cliente.direccionValida' => $this->direccionValida]);
            session(['cliente.comunaDespacho' => $this->comunaDespacho]);
            session(['cliente.is_ok_level_3' => $this->is_ok_level_3]);
            session(['cliente.fechaDespacho' => $this->fechaDespacho]);

                    
        }else{
            $this->direccionValida=2;
            $this->fechaDespacho ="";
            $this->is_ok_level_2 = false;
            $this->is_ok_level_3 = false;

            session(['cliente.direccionValida' => $this->direccionValida]);
            session(['cliente.fechaDespacho' => $this->fechaDespacho]);
            session(['cliente.is_ok_level_2' => $this->is_ok_level_2]);
            session(['cliente.is_ok_level_3' => $this->is_ok_level_3]);
        }

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
    public function validateLevel2(){
        $this->validate();
        if($this->celularValido==1){
            $this->msjErrorCelular="";
            $datosClientes = [
                'name'=> $this->name,
                'email'=> $this->email,
                'comuna'=> $this->comuna,
                'direccion'=> $this->direccion,
                'celular'=> $this->celular,
                'block'=> $this->block,
                'depto'=> $this->depto,
                'latitud'=> $this->latitud,
                'longitud'=> $this->longitud,
                'comentario'=> $this->comentario,
            ];
            session(['cliente.datos' => $datosClientes]);
    
            $this->open_level_2 = false;
            session(['cliente.open_level_2' => $this->open_level_2]);
            $this->is_ok_level_2 = true;
            session(['cliente.is_ok_level_2' => $this->is_ok_level_2]);
    
           
            $this->fechaDespacho = 0;
            session(['cliente.fechaDespacho'=>  $this->fechaDespacho]);
            $this->totalDespacho = 0;
            session(['cliente.totalDespacho'=> $this->totalDespacho]);
    
            $this->is_ok_level_3 = false;
            session(['cliente.is_ok_level_3'=> $this->is_ok_level_3]);

              
            $this->abrirNivelPendiente();
        }      
    }
    public function editLevel2(){

        $this->open_level_2 = true;
        session(['cliente.open_level_2' => $this->open_level_2]);
        $this->open_level_3 = false;
        session(['cliente.open_level_3' => $this->open_level_3]);
        $this->open_level_4 = false;
        session(['cliente.open_level_4' => $this->open_level_4]);
        $this->open_level_1 = false;
        session(['cliente.open_level_1' => $this->open_level_1]);



        $this->is_ok_level_2 = 0;
        session(['cliente.is_ok_level_1' => $this->is_ok_level_1]);

        $this->direccionValida = 1;
        session(['cliente.direccionValida' => $this->direccionValida]);
    }


    // NIVEL 3 FECHA DE DESPACHO
    public function validateLevel3($fecha, $valor){
        $this->fechaDespacho = Carbon::createFromFormat('Y-m-d H:i:s', $fecha)->locale('es');
        session(['cliente.fechaDespacho' => $this->fechaDespacho]);

        $this->totalDespacho = $valor;
        session(['cliente.totalDespacho' => $this->totalDespacho]);

        $this->open_level_3 = false;
        session(['cliente.open_level_3' => $this->open_level_3]);
        $this->is_ok_level_3 = true;
        session(['cliente.is_ok_level_3' => $this->is_ok_level_3]);

        $this->abrirNivelPendiente();

        // $this->date = Carbon::now()->locale('es');  
    }
    public function editFecha() {
         $this->open_level_2 = false;
        session(['cliente.open_level_2' => $this->open_level_2]);
        $this->open_level_3 = true;
        session(['cliente.open_level_3' => $this->open_level_3]);
        $this->open_level_4 = false;
        session(['cliente.open_level_4' => $this->open_level_4]);
        $this->open_level_1 = false;
        session(['cliente.open_level_1' => $this->open_level_1]);
    }
    

    public function abrirNivelPendiente(){
        if ($this->is_ok_level_1 == false) {
            $this->open_level_1 = true;
            session(['cliente.open_level_1' => $this->open_level_1]);
          } else 
          if ($this->is_ok_level_2 == false) {
            $this->open_level_2 = true;
            session(['cliente.open_level_2' => $this->open_level_2]);
          } else if ($this->is_ok_level_3 == false) {
              $this->open_level_3 = true;
              session(['cliente.open_level_3' => $this->open_level_3]);
          } else {
              $this->open_level_4 = true;
              session(['cliente.open_level_4' => $this->open_level_4]);
          }
    }

    public function cargarFechasDespacho(){
         
        $period = CarbonPeriod::create(Carbon::tomorrow('America/Santiago')->locale('es_ES'), 7); 
        foreach ($period as  $fecha) {
            $valor_despacho ="";
            $oferta=0;

            
            if ($fecha->isoFormat('E') == 7) {
                continue;
            }
            

            if ( strpos($this->comunaDespacho->dias_rebajados, $fecha->isoFormat('E')) !== false) {
                $valor_despacho = $this->comunaDespacho->valor_rebajado;
                $oferta = 1;

            }else{
                $valor_despacho = $this->comunaDespacho->valor_despacho;
            }
            $agendable = 1;
            if (Calendario::where('agendable','0')->where('fecha','=',$fecha->toDateString())->first()){
                $agendable = 0;
            }

            $copado = 0;
            
            $total_diario =  Sale::where('delivery_date', $fecha->toDateString())->sum('total');
            if($total_diario > 700000){
                $copado = 1;
            }

            
        

            $this->fechasDespacho []= [
                'fecha_despacho' =>  $fecha->toDateTimeString(),
                'valor_despacho' =>  $valor_despacho,
                'nombre_dia' =>  $fecha->dayName,
                'dia_del_mes' =>  $fecha->day,
                'nombre_mes' =>  $fecha->monthName,
                'anio' =>  $fecha->year,
                'id' =>  $fecha->isoFormat('E'),
                'agendable'=>$agendable,
                'oferta'=>$oferta,
                'copado'=>$copado,
            
            ];
        }
    }
 
   

    public function eliminarTodo(){
       
        $this->eliminado = session()->pull('cliente' , 'default');
        $this->mount();
        $this->render();
    }

    public function verComunasDisponibles(){
        $this->modal = true;
        $this->comunas_disponibles = Comuna::where('tiene_reparto','1')->get();
    }



   
   
}

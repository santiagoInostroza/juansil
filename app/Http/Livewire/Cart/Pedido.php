<?php

namespace App\Http\Livewire\Cart;

use Exception;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Comuna;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Str;

class Pedido extends Component
{

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
    
    public $openRevisarPedido =1;
    public $isValidRevisarPedido = 0;
    
    public $openDatosDespacho =0;
    public $isValidDatosDespacho =0;
    
    public $openFechaDespacho =0;
    public $isValidFechaDespacho =0;

    public $openResumen =0;

    public $idFechaSeleccionada ="";
    public $totalDespacho = 0;
    public $fechaDespacho;
    public $direccionValida=0;
    public $celularValido=1;
    public $msjErrorCelular="";
    public $comunaDespacho; 
    public $totalCarrito;


    public $params;
    public $response;

    public function flow(){

        //Ordenando los parámetros:
        $params =array( 
            "apiKey" => "656B75FB-F6A6-48FE-9749-81244695L999",
            "token" => "AJ089FF5467367",
        );

        $keys = array_keys($params);
        sort($keys);

        //Concatenando:
        $toSign = "";
        foreach($keys as $key) {
            $toSign .= $key . $params[$key];
        };

        $secretKey='4df0e0d49429c7a7d597b0ae5c7039788a35f877';

        //Firmando:
        $signature = hash_hmac('sha256', $toSign , $secretKey);
        // $url = 'https://www.flow.cl/api';
        $url = 'https://sandbox.flow.cl/api'; //URL DE PRUEBA

        $this->flowMetodoGet($url,$signature);
  
    }

    public function flowMetodoGet($url,$signature)
    {
         // Agrega a la url el servicio a consumir
         $url = $url . '/payment/getStatus';
         // agrega la firma a los parámetros
         $params["s"] = $signature;
         //Codifica los parámetros en formato URL y los agrega a la URL
         $url = $url . "?" . http_build_query($params);
         try {
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
             $response = curl_exec($ch);
             if($response === false) {
                 $error = curl_error($ch);
                 throw new Exception($error, 1);
             } 
             $info = curl_getinfo($ch);
             if(!in_array($info['http_code'], array('200', '400', '401')) ) {
                     throw new Exception( 'Unexpected error occurred. HTTP_CODE: ' . $info['http_code'] , $info['http_code']);
             }
 
             $this->response = $response;
 
         } catch (Exception $e) {
             $this->response = 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
         }
    }



    protected $listeners = [
        'validarDireccion','render','mount'
    ];
    protected $rules = [
        'direccion' => 'required',
        'comuna' => 'required',
        'name' => 'required',
        'celular' => 'required'
    ];
    protected $messages = [
        'direccion.required' => 'El campo direccion no puede estar vacio.',
        'comuna.required' => 'El campo comuna no puede estar vacio.',
        'name.required' => 'El campo contacto no puede estar vacio.',
        'celular.required' => 'El campo celular no puede estar vacio.',
    ];
    
    public function mount(){

        $this->date = Carbon::now()->locale('es');
 
        // VERIFICAR SI PEDIDO ESTA CONFIRMADO
        if(session()->has('cliente.openRevisarPedido')){
            $this->openRevisarPedido= session('cliente.openRevisarPedido');
        }
        if(session()->has('cliente.isValidRevisarPedido')){
            $this->isValidRevisarPedido= session('cliente.isValidRevisarPedido');
        }

        // VERIFICAR SI DATOS DE DESPACHO ESTA VALIDADOS
        if(session()->has('cliente.openDatosDespacho')){
            $this->openDatosDespacho= session('cliente.openDatosDespacho');
        }
        if(session()->has('cliente.isValidDatosDespacho')){
            $this->isValidDatosDespacho= session('cliente.isValidDatosDespacho');
        }

        // VERIFICAR SI FECHA DE DESPACHO ESTA VALIDADOS
        if(session()->has('cliente.openFechaDespacho')){
            $this->openFechaDespacho= session('cliente.openFechaDespacho');
        }
        if(session()->has('cliente.isValidFechaDespacho')){
            $this->isValidFechaDespacho= session('cliente.isValidFechaDespacho');
        }

         // VERIFICAR SI SE MUESTRA RESUMEN
         if(session()->has('cliente.openResumen')){
            $this->openResumen= session('cliente.openResumen');
        }

        // VERIFICAR SI EXISTE TOTAL DE DESPACHO 
        if(session()->has('cliente.totalDespacho')){
            $this->totalDespacho= session('cliente.totalDespacho');
        }

        // VERIFICAR SI EXISTE ID DE FECHA SELECCIONADA
        if(session()->has('cliente.idFechaSeleccionada')){
            $this->idFechaSeleccionada= session('cliente.idFechaSeleccionada');
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
        }

       if(session()->has('totalCarrito')){
           $this->totalCarrito= session('totalCarrito');
        }
        
        if(session()->has('cliente.comunaDespacho')){
             $this->comunaDespacho= session('cliente.comunaDespacho');
        }



     }

    
     public function render(){
        $this->date = Carbon::now()->locale('es');
        return view('livewire.cart.pedido');
    }


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
                }

                $this->comunaDespacho = Comuna::where('name' ,Str::upper($comuna))->first();
                
                if($this->comunaDespacho){
                    $this->direccionValida=1;
                    $this->latitud = $lat;
                    $this->longitud = $lng;
                }else{
                    $this->direccionValida=4; 
                    $this->isValidDatosDespacho = 0;

                    $this->idFechaSeleccionada="";
                    $this->fechaDespacho ="";
                    $this->isValidFechaDespacho = 0;
                }   

            } catch (\Throwable $th) {
                $this->direccionValida=3; 
                $this->isValidDatosDespacho = 0;

                $this->idFechaSeleccionada="";
                $this->fechaDespacho ="";
                $this->isValidFechaDespacho = 0;
                
                
            }

            session(['cliente.datos.name' => $this->name]);
            session(['cliente.datos.celular' => $this->celular]);
            session(['cliente.datos.block' => $this->block]);
            session(['cliente.datos.depto' => $this->depto]);
            session(['cliente.datos.comentario' => $this->comentario]);
            session(['cliente.datos.direccion' => $this->direccion]);
            session(['cliente.datos.comuna' => $this->comuna]);
            session(['cliente.datos.latitud' => $this->latitud]);
            session(['cliente.datos.longitud' => $this->longitud]);
            session(['cliente.isValidDatosDespacho' => $this->isValidDatosDespacho]);
            session(['cliente.direccionValida' => $this->direccionValida]);
            session(['cliente.comunaDespacho' => $this->comunaDespacho]);
            session(['cliente.isValidFechaDespacho' => $this->isValidFechaDespacho]);
            session(['cliente.fechaDespacho' => $this->fechaDespacho]);
            session(['cliente.idFechaSeleccionada' => $this->idFechaSeleccionada]);

                    
        }else{
            $this->direccionValida=2;
            $this->isValidDatosDespacho = 0;

            $this->idFechaSeleccionada="";
            $this->fechaDespacho ="";
            $this->isValidFechaDespacho = 0;

            session(['cliente.direccionValida' => $this->direccionValida]);
            session(['cliente.isValidDatosDespacho' => $this->isValidDatosDespacho]);
            session(['cliente.isValidFechaDespacho' => $this->isValidFechaDespacho]);
            session(['cliente.fechaDespacho' => $this->fechaDespacho]);
            session(['cliente.idFechaSeleccionada' => $this->idFechaSeleccionada]);
        }

    }



    public function validateRevisarPedido(){
        $this->openRevisarPedido = 0;
        session(['cliente.openRevisarPedido' => $this->openRevisarPedido]);
        $this->isValidRevisarPedido = 1;
        session(['cliente.isValidRevisarPedido' => $this->isValidRevisarPedido]);


        if ($this->isValidRevisarPedido != 1) {
          $this->openRevisarPedido = 1;
          session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
        } else 
        if ($this->isValidDatosDespacho != 1) {
          $this->openDatosDespacho = 1;
          session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
        } else if ($this->isValidFechaDespacho != 1) {
            $this->openFechaDespacho = 1;
            session(['cliente.openFechaDespacho' => $this->openFechaDespacho]);
        } else {
            $this->openResumen = 1;
            session(['cliente.openResumen' => $this->openResumen]);
        }
      
    }

    public function editRevisarPedido(){

        $this->openDatosDespacho = 0;
        session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
        $this->openFechaDespacho = 0;
        session(['cliente.openFechaDespacho' => $this->openFechaDespacho]);
        $this->openResumen = 0;
        session(['cliente.openResumen' => $this->openResumen]);


        $this->openRevisarPedido = 1;
        session(['cliente.openRevisarPedido' => $this->openRevisarPedido]);
      
       
    }


    public function validateDatosDespacho(){
        $this->validate();
        if($this->celularValido==1){
            $this->msjErrorCelular="";
            $datosClientes = [
                'name'=> $this->name,
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
    
            $this->openDatosDespacho = 0;
            session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
            $this->isValidDatosDespacho = 1;
            session(['cliente.isValidDatosDespacho' => $this->isValidDatosDespacho]);
    
            $this->idFechaSeleccionada = 0;
            session(['cliente.idFechaSeleccionada'=>  $this->idFechaSeleccionada]);
            $this->fechaDespacho = 0;
            session(['cliente.fechaDespacho'=>  $this->fechaDespacho]);
            $this->totalDespacho = 0;
            session(['cliente.totalDespacho'=> $this->totalDespacho]);
    
            $this->isValidFechaDespacho = 0;
            session(['cliente.isValidFechaDespacho'=> $this->isValidFechaDespacho]);
    
    
            if ($this->isValidRevisarPedido != 1) {
              $this->openRevisarPedido = 1;
              session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
            } else 
            if ($this->isValidDatosDespacho != 1) {
              $this->openDatosDespacho = 1;
              session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
            } else if ($this->isValidFechaDespacho != 1) {
                $this->openFechaDespacho = 1;
                session(['cliente.openFechaDespacho' => $this->openFechaDespacho]);
            } else {
                $this->openResumen = 1;
                session(['cliente.openResumen' => $this->openResumen]);
            }

        }


       
      
    }

    public function editDatosDespacho(){

        $this->openDatosDespacho = 1;
        session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
        $this->openFechaDespacho = 0;
        session(['cliente.openFechaDespacho' => $this->openFechaDespacho]);
        $this->openResumen = 0;
        session(['cliente.openResumen' => $this->openResumen]);
        $this->openRevisarPedido = 0;
        session(['cliente.openRevisarPedido' => $this->openRevisarPedido]);



        $this->isValidDatosDespacho = 0;
        session(['cliente.isValidRevisarPedido' => $this->isValidRevisarPedido]);

        $this->direccionValida = 1;
        session(['cliente.direccionValida' => $this->direccionValida]);
    }

    public function seleccionarFecha($id, $fecha, $valor){
        $this->idFechaSeleccionada=$id;
        session(['cliente.idFechaSeleccionada' => $this->idFechaSeleccionada]);

        $this->fechaDespacho =Carbon::createFromFormat('Y-m-d H:i:s',  $fecha)->locale('es');
        session(['cliente.fechaDespacho' => $this->fechaDespacho]);

        $this->totalDespacho = $valor;
        session(['cliente.totalDespacho' => $this->totalDespacho]);

        $this->openFechaDespacho = 0;
        session(['cliente.openFechaDespacho' => $this->openFechaDespacho]);
        $this->isValidFechaDespacho = 1;
        session(['cliente.isValidFechaDespacho' => $this->isValidFechaDespacho]);

        if ($this->isValidRevisarPedido != 1) {
            $this->openRevisarPedido = 1;
            session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
          } else 
          if ($this->isValidDatosDespacho != 1) {
            $this->openDatosDespacho = 1;
            session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
          } else if ($this->isValidFechaDespacho != 1) {
              $this->openFechaDespacho = 1;
              session(['cliente.openFechaDespacho' => $this->openFechaDespacho]);
          } else {
              $this->openResumen = 1;
              session(['cliente.openResumen' => $this->openResumen]);
          }
        $this->date = Carbon::now()->locale('es');  
    }

    public function editFecha() {
         $this->openDatosDespacho = 0;
        session(['cliente.openDatosDespacho' => $this->openDatosDespacho]);
        $this->openFechaDespacho = 1;
        session(['cliente.openFechaDespacho' => $this->openFechaDespacho]);
        $this->openResumen = 0;
        session(['cliente.openResumen' => $this->openResumen]);
        $this->openRevisarPedido = 0;
        session(['cliente.openRevisarPedido' => $this->openRevisarPedido]);
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

    public function eliminarTodo()
    {
       
        $this->eliminado = session()->pull('cliente' , 'default');
        $this->mount();
        $this->render();
    }

   
   
}

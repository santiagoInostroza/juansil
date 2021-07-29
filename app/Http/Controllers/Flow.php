<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class Flow extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public $params;
    public $response;
    public $url;
    public $msj_error ="";

    public function setFlow(){
        $this->params =array( 
            "apiKey" => "656B75FB-F6A6-48FE-9749-81244695L999",
            "token" => "AJ089FF5467367",
        );
        // $this->url = 'https://www.flow.cl/api';
        $this->url = 'https://sandbox.flow.cl/api'; //URL DE PRUEBA

    }
    public function getSignature()
    {
        $keys = array_keys($this->params);
        sort($keys);
        $toSign = "";
        foreach($keys as $key) {
            $toSign .= $key . $this->params[$key];
        };
        $secretKey='4df0e0d49429c7a7d597b0ae5c7039788a35f877';
        $signature = hash_hmac('sha256', $toSign , $secretKey);
        $this->params["s"] = $signature;
    }

    public function createPayment(){

        $optional = array(
            "rut" => "9999999-9",
            "otroDato" => "otroDato"
        );
        $optional = json_encode($optional);

        $ultima_venta = Sale::latest()->first();
        // $this->params["commerceOrder"] = 123456; 
        $this->params["commerceOrder"] = 3;
        $this->params["subject"] ='Pago de prueba';
        $this->params["currency"] ="CLP";
        $this->params["amount"] =$this->totalCarrito;
        $this->params["email"] =$this->email;
        $this->params["paymentMethod"] =9;
        $this->params["urlConfirmation"] =route('flow');
        $this->params["urlReturn"] =route('flow2');
        // $this->params["optional"] =$optional;
        // $this->params["timeout"] ='santiagoinostroza2@gmail.com';
        // $this->params["merchantId"] ='santiagoinostroza2@gmail.com';
        // $this->params["payment_currency"] ='santiagoinostroza2@gmail.com';

        $this->getSignature();

        $this->url .= '/payment/create';
        $this->flowMetodoPost();
        
    }
    public function getStatus(){
        $this->url .= '/payment/getStatus';
    }

    public function flowMetodoGet(){
        $this->url .= "?" . http_build_query($this->params);
         try {
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $this->url);
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
             $this->response = 'Error Get: ' . $e->getCode() . ' - ' . $e->getMessage();
         }
    }

    public function flowMetodoPost(){
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->params);
            $response = curl_exec($ch);
            if($response === false) {
                $error = curl_error($ch);
                throw new Exception($error, 1);
            } 
            $info = curl_getinfo($ch);
            if(!in_array($info['http_code'], array('200', '400', '401')) ){
                throw new Exception('Unexpected error occurred. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
            }

            $resp = json_decode($response);
            if (isset($resp->url) ) {
                $url = $resp->url;
                $token = $resp->token;
                $flowOrder = $resp->flowOrder;
                return redirect( $url . "?token=" . $token);
             }
             if(isset($resp->code)){
                $code = $resp->code;
                if($code == 1605){//Orden ya pagada
                    $this->msj_error = "El número de orden " . $this->params["commerceOrder"] . " ya ha sido pagado";
                   
                }
             }else{
                 $this->response = $response;
                }
        } catch (Exception $e) {
            $this->response = 'Error Post: ' . $e->getCode() . ' - ' . $e->getMessage();
        }   
    }

}

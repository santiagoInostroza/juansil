<?php

namespace App\Http\Controllers\admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VincularCuentaUsuarioCliente extends Controller{

    public function vincular(){
        $customer = Customer::where('email', Auth::user()->email)->first();
        if($customer){
            // EXISTE, SE VINCULA
            $customer->user_id = Auth::user()->id;
            $customer->save();
            return true;
        }else{
            return false;
        }
    }
}

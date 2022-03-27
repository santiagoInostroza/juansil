<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class Helper extends Controller
{
    public static function fecha($fecha){
        if ($fecha!="") {
            return Carbon::parse($fecha);
        }
        return false;
    } 
    public static function date($fecha){
        if ($fecha!="") {
            return Carbon::parse($fecha);
        }
        return false;
    } 

    public static function fechaHora($fecha){
        if ($fecha!="") {
            return Carbon::createFromFormat('Y-m-d H:i:s', $fecha)->locale('es')->timezone('America/Santiago');
        }
    }
}

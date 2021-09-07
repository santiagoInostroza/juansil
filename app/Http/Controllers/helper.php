<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class Helper extends Controller
{
    public static function fecha($fecha){
        return Carbon::parse($fecha);
        // return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    } 
    public static function fechaHora($fecha){
        return Carbon::createFromFormat('Y-m-d H:i:s', $fecha)->locale('es')->timezone('America/Santiago');
    }
}

<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;

class helper extends Controller{


    public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }
}

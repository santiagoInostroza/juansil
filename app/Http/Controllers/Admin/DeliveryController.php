<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    public function index($fecha=""){

        if ($fecha =="") {
            $fecha=date("Y-m-d");
        }
       
       return view("admin.deliveries.index",compact('fecha'));    
    }


    public function index2($fecha=""){

        if ($fecha =="") {
            $fecha=date("Y-m-d");
        }
       
       return view("admin.deliveries.index2",compact('fecha'));    
    }

    public function create()
    {
       return "CREATE";
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

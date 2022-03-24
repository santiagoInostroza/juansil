<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DeliveryController extends Controller
{
    public function index($date=""){

        if ($date =="") {
            $date=date("Y-m-d");
        }
       
       return view("admin.deliveries.index",compact('date'));    
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

    public function payOrder(Sale $sale, $account){
        //Si account es null es porque se deshizo el pago, por lo tanto se revierte todo el pago
      
       $sale->payment_status=($account == null) ? 1 : 3;
       $sale->payment_date=($account == null) ? null : Carbon::now();
       $sale->payment_amount=($account == null) ? 0 :  $sale->pending_amount;
       $sale->pending_amount=($account == null) ?  $sale->payment_amount : 0;
       $sale->payment_account=($account == null) ? null : $account;
       $sale->user_payment= ($account == null) ? null : auth()->user()->id;
       $sale->save();
       return $sale;
    }
    public function deliverOrder(Sale $sale,$reverse){
        // SI reverse ES TRUE REVIERTE EL ENTREGADO A NO ENTREGADO
        
        $sale->delivery_stage=($reverse)? null : 1;
        $sale->date_delivered=($reverse)? null :Carbon::now();
        $sale->delivered_user= ($reverse)? null : auth()->user()->id;
        $sale->save();
    }
}

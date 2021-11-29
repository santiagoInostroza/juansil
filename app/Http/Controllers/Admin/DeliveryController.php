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


    // public function index2($date=""){

    //     if ($date =="") {
    //         $date=date("Y-m-d");
    //     }
       
    //    return view("admin.deliveries.index2",compact('date'));    
    // }

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
       $sale->payment_status=3;
       $sale->payment_date=Carbon::now()->timezone('America/Santiago');
       $sale->payment_amount= $sale->pending_amount;
       $sale->pending_amount=0;
       $sale->payment_account=$account;
       $sale->user_payment= auth()->user()->id;
       $sale->save();
    }
    public function deliverOrder(Sale $sale){
        $sale->delivery_stage=1;
        $sale->date_delivered=Carbon::now()->timezone('America/Santiago');
        $sale->delivered_user= auth()->user()->id;
        $sale->save();
    }
}

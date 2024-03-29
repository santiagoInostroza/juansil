<?php

namespace App\Http\Livewire\Admin\Sales;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class PaymentVerification extends Component{
    public function render(){
        return view('livewire.admin.sales.payment-verification',[
           'paymentsPendingVerification' => Sale::where('payment_receipt_date', '!=' , null)->where(function($query){
               $query->orWhere('verify_payment_receipt', null)->orWhere('verify_payment_receipt', 0);
           })->get(),
        ]);
    }

    public function verify(Sale $sale){
       $sale->verify_payment_receipt = 1;
       $sale->verify_payment_receipt_by = auth()->user()->id;
       $sale->verify_payment_receipt_date = Carbon::now();
       $sale->save();
       $this->dispatchBrowserEvent('toast',['title' =>' has verificado el pago.']);
    
    }
}

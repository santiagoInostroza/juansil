<?php

namespace App\Http\Livewire\Billings;

use Livewire\Component;

class PaymentMethodList extends Component
{

    protected $listeners = ['render'];


    public function render()
    {
        $paymentMethods = auth()->user()->paymentMethods();
        return view('livewire.billings.payment-method-list',compact('paymentMethods'));
    }
    public function deletePaymentMethod($paymentMethodId){

        $paymentMethod = auth()->user()->findPaymentMethod($paymentMethodId);
        $paymentMethod->delete();

    }

    public function defaultPaymentMethod($paymentMethodId)
    {
        auth()->user()->updateDefaultPaymentMethod($paymentMethodId);
    }
}

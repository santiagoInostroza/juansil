<?php

namespace App\Http\Livewire\Billings;

use Livewire\Component;

class PaymentMethodCreate extends Component
{

   

    protected $listeners = [
        'paymentMethodCreate'
    ];


    public function render()
    {

        $this->emit('resetStripe');
        return view('livewire.billings.payment-method-create', [
            'intent' => auth()->user()->createSetupIntent()
        ]);
    }

    public function paymentMethodCreate ($paymentMethod){

        if (auth()->user()->hasPaymentMethod()) {
         
            auth()->user()->addPaymentMethod($paymentMethod);
        }else{
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }


       $this->emitTo('billings.payment-method-list', 'render');
       $this->emitTo('billings.subscriptions', 'render');
    }
}

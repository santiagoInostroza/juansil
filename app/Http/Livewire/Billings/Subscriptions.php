<?php

namespace App\Http\Livewire\Billings;

use Livewire\Component;

class Subscriptions extends Component
{


    protected $listeners =([
        'render'
    ]);

    public function render(){
        return view('livewire.billings.subscriptions');
    }


    public function newSubscription($name, $price){
        
        auth()->user()->newSubscription($name, $price)->create();
        $this->emitTo('billings.invoices','render');

    }

    public function changinPlans($name, $price){

        auth()->user()->subscription($name)->swap($price);
        $this->emitTo('billings.invoices','render');
    }

    public function cancellingSubscription($name){

        auth()->user()->subscription($name)->cancel();

    }

    public function resuminSubscription($name){

        auth()->user()->subscription($name)->resume();

    }
}

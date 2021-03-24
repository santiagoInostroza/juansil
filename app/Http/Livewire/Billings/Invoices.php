<?php

namespace App\Http\Livewire\Billings;

use Livewire\Component;

class Invoices extends Component
{

    
    protected $listeners = (['render']);


    public function render()
    {

        $invoices = auth()->user()->invoices();

        return view('livewire.billings.invoices', compact('invoices'));
    }
}

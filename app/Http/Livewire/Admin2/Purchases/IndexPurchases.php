<?php

namespace App\Http\Livewire\Admin2\Purchases;

use Livewire\Component;
use App\Models\Purchase;

class IndexPurchases extends Component{

    public function render(){
        return view('livewire.admin2.purchases.index-purchases',[
            'allPurchases' => Purchase::all()
        
        ]);
    }
}

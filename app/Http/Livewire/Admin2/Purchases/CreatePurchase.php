<?php

namespace App\Http\Livewire\Admin2\Purchases;

use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;

class CreatePurchase extends Component{
    public $supplier_id;
    public $searchProduct;

    public function mount(){
        $this->supplier_id = null;
        $this->searchProduct = null;
    }

    

    public function render(){
        return view('livewire.admin2.purchases.create-purchase',[
            'suppliers' => Supplier::orderBy('name','asc')->get(),
            'allPurchases' => Purchase::all(),
            'allProducts' => Product::all(),
        ]);
    }
}

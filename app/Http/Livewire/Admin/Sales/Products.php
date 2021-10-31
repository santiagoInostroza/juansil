<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Http\Controllers\Admin\SaleController;
use App\Models\Product;
use Livewire\Component;

class Products extends Component{
    public $search;
    public $view = 2;

    public function render(){

        $products = Product::where('name' , 'like' ,  '%' . $this->search . '%' )->get();
        return view('livewire.admin.sales.products',compact('products'));
    }

    public function addToTemporalOrder($id, $quantity, $price){
        $saleController = new SaleController();
        $saleController->addToTemporalOrder($id, $quantity, $price);
        $this->emitTo('admin.sales.new-order', 'render');
    }
}

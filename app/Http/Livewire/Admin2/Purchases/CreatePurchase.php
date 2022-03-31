<?php

namespace App\Http\Livewire\Admin2\Purchases;

use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use PHPUnit\Util\Json;

class CreatePurchase extends Component{
    public $supplier_id;

    protected $listeners=[
        'addToPurchase'
    ];   

    public function mount(){
        // session()->forget('newPurchase');
        $this->supplier_id = null;       
    }    

    public function render(){
        return view('livewire.admin2.purchases.create-purchase',[
            'suppliers' => Supplier::orderBy('name','asc')->get(),
        ]);
    }

   

    public function addToPurchase($product_id){

        $product = Product::find($product_id);
        if(session()->has('newPurchase.items.'.$product->name) ){
            $this->dispatchBrowserEvent('toast', ['title'=>'ya está agregado']);
            return;
        }
        session([
            'newPurchase.items.'.$product->name => [
                'product_id' => $product->id,
                'name' => $product->name,
                'stock' => $product->stock,
                'quantity' => 0,
                'quantity_box' => 0,
                'total_quantity' => 0,
                'price' => 0,
                'total_price' => 0,
                'price_box' => 0,
            ] 
        ]);      
    }


    public function removeFromPurchase( $product_name){
        session()->forget('newPurchase.items.'.$product_name);
        $this->getTotal();
    }

    public function setPurchase($key,$quantity,$quantity_box,$total_quantity,$price,$price_box,$total_price){
         session([
            'newPurchase.items.'.$key. '.quantity' => $quantity,
            'newPurchase.items.'.$key. '.quantity_box' => $quantity_box,
            'newPurchase.items.'.$key. '.total_quantity' => $total_quantity,
            'newPurchase.items.'.$key. '.price' => $price,
            'newPurchase.items.'.$key. '.price_box' => $price_box,
            'newPurchase.items.'.$key. '.total_price' => $total_price,
            ]);
        // $this->dispatchBrowserEvent('consolelog',['consolelog'=>session('newPurchase.items.'.$key. '.quantity')]);
        $this->getTotal();
    }

    public function getTotal(){
        $total = 0;
        foreach (session('newPurchase.items') as $key => $item) {
            $total+= $item['total_price'];
        }
        session(['newPurchase.total' =>$total]);
    
    }
}

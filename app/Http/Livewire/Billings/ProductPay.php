<?php

namespace App\Http\Livewire\Billings;

use App\Models\Product;
use Livewire\Component;

class ProductPay extends Component
{

    protected $listeners =([
        'paymentMethodCreate'
    ]);

    public $product;
   

    public function mount(Product $product)
    {
        $this->product=$product;
        
    }


    public function render()
    {
        return view('livewire.billings.product-pay');
    }

    public $prueba;
    public function paymentMethodCreate($paymentMethod)
    {
        $precio= intval($this->product->salePrices[0]->price/713.53*100 );      
        $this->prueba=$precio;
        auth()->user()->charge($precio, $paymentMethod);
        $this->emit('resetStripe');
        
    }
}

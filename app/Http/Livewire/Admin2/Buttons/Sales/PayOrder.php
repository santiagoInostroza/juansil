<?php

namespace App\Http\Livewire\Admin2\Buttons\Sales;

use App\Models\Sale;
use Livewire\Component;
use App\Http\Controllers\Admin\DeliveryController;

class PayOrder extends Component{
    public $sale;

    public $accounts;

    public function mount(){
        $this->accounts =[
            1=> 'Efectivo',
            2=>'Cuenta rut Paty',
            3=>'Cuenta rut Santy',
            4=> 'Cuenta rut Silvia',
            5=> 'Cuenta Santander',
            6=> 'Cuenta Juansil ',
            7=>  'Otra',
        ];
    }

    public function render(){

        return view('livewire.admin2.buttons.sales.pay-order');
    }

    public function payOrder(Sale $sale, $account = 1){
        $deliveryController= new DeliveryController();
        $sale = $deliveryController->payOrder($sale, $account);
        $this->dispatchBrowserEvent('orderUpdate', 
            [
                'id' => $sale->id,
                'delivery_stage' => $sale->delivery_stage,
                'payment_status' => $sale->payment_status,
            ]);
        $this->emit('render');
    }

}

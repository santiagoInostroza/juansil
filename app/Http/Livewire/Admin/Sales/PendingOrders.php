<?php

namespace App\Http\Livewire\Admin\Sales;

use Livewire\Component;

class PendingOrders extends Component{
    public $estado_pago=0;
    public $openComentario=false;
    public $delivery=false;

    protected $listeners=[
        'render'
    ];

    public function render(){
        return view('livewire.admin.sales.pending-orders');
    }
}
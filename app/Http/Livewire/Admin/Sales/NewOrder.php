<?php

namespace App\Http\Livewire\Admin\Sales;

use Livewire\Component;

class NewOrder extends Component{

    public $estado_pago=1;
    public $openComentario=false;
    public $delivery=false;

    protected $listeners=[
        'render'
    ];

    public function render()
    {
        return view('livewire.admin.sales.new-order');
    }
}

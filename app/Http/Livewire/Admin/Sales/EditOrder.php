<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;

class EditOrder extends Component{
    public $search;
    public $view = 2;

    public $estado_pago=1;
    public $openComentario=false;
    public $delivery=false;
    public $fecha_entrega;
    public $valor_despacho;
    public $delivered;
    public $customerId;
    public $comentario;
    public $items;

    public $orderSelected;
    public $sale;



    protected $listeners=[
        'render',
    ];

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function render(){

        $products = Product::where('name' , 'like' ,  '%' . $this->search . '%' )->get();

        if (session()->has('venta.items')) {
            $this->items = session('venta.items');
        }

        return view('livewire.admin.sales.edit-order',compact('products'));
    }

  
}

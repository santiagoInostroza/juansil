<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Http\Controllers\Admin\SaleController;
use Hamcrest\Core\HasToString;
use Livewire\Component;

class NewOrder extends Component{

    public $estado_pago=1;
    public $openComentario=false;
    public $delivery=false;

    protected $listeners=[
        'render'
    ];

    public function render(){
        return view('livewire.admin.sales.new-order');
    }

                  
    public function removeFromTemporalOrder($itemId){
        $saleController= new SaleController();
        $saleController->removeFromTemporalOrder($itemId);
        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => "Eliminado",
        ]); 
    }

    public function setQuantity($itemId,$quantity){
        $data=[
            'itemId'=> $itemId,
            'quantity'=>$quantity,
        ];
        $saleController= new SaleController();
        $saleController->setTemporalOrder($data);

        $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => '',
        ]); 

    }

    public function setQuantityBox($itemId,$quantityBox){
        $data=[
            'itemId'=>$itemId,
            'quantityBox'=>$quantityBox,
        ];
        $saleController= new SaleController();
        $saleController->setTemporalOrder($data);
    }


    

}

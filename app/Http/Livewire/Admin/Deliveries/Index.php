<?php

namespace App\Http\Livewire\Admin\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class Index extends Component{

    public $showAgregarDespacho = false;
    public $date;


    protected $listeners = ['closeAgregarProducto'];



    public function render(){
        $orders = Sale::where('delivery','1')->whereDate('delivery_date', $this->date)->get();    
      
        return view('livewire.admin.deliveries.index',compact('orders'));
    }
    
    public function closeAgregarProducto(){
        $this->showAgregarDespacho = false;
    }




}

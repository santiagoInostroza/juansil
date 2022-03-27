<?php

namespace App\Http\Livewire\Admin2\Sales;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class IndexRowSales extends Component{
    public $columns;
    public $sale;
    public function render(){
        return view('livewire.admin2.sales.index-row-sales');
    }

    public function setBoleta(){
        $this->sale->boleta = 1;
        $this->sale->fecha_boleta = Carbon::now();
        $this->sale->user_boleta = auth()->user()->id;
        $this->sale->save();
 
     }
}

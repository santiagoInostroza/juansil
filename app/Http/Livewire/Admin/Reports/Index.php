<?php

namespace App\Http\Livewire\Admin\Reports;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class Index extends Component{

    public $showSales = true;

    public function render(){

        $sales = Sale::all();
        return view('livewire.admin.reports.index',compact('sales'));
    }

    public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }
}

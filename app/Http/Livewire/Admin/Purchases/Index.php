<?php

namespace App\Http\Livewire\Admin\Purchases;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\WithPagination;
use App\Http\Controllers\helper;

class Index extends Component{

    // use WithPagination;
    public $openShowDetails = false;
    public $openNewPurchase = true;
    public $fecha_compra;

    public $purchase_selected;
   
    public $search;

    public $suppliers;
    
    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount(){
        $this->suppliers =  Supplier::all();
    }
    
    public function render(){
        $purchases = Purchase::join('suppliers','suppliers.id','=','purchases.supplier_id')
        ->leftJoin('users','users.id','=','purchases.user_created')
        ->where('suppliers.name','like','%'. $this->search .'%')
        ->orWhere('total','like','%'. $this->search .'%')
        ->orWhere('fecha','like','%'. $this->search .'%')
        ->orWhere('comments','like','%'. $this->search .'%')
        ->orWhere('users.name','like','%'. $this->search .'%')
        ->select('purchases.*')
        ->orderBy('id','desc')
        ->paginate(25);
        return view('livewire.admin.purchases.index',compact('purchases'));
    }

    public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }

    public function showDetails($purchase_id){
        $this->purchase_selected= Purchase::find($purchase_id);
        $this->openShowDetails = true;
    }
    public function newPurchase(){
        $this->openNewPurchase = true;
        $this->fecha_compra =Carbon::now()->locale('es')->timezone('America/Santiago')->format('Y-m-d');
    }
   
}

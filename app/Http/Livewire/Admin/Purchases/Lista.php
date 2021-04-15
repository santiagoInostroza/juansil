<?php

namespace App\Http\Livewire\Admin\Purchases;

use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;

class Lista extends Component{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    
    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render(){
        $purchases = Purchase::join('suppliers','suppliers.id','=','purchases.supplier_id')
        ->leftJoin('users','users.id','=','purchases.user_created')
        ->where('suppliers.name','like','%'. $this->search .'%')
        ->orWhere('total','like','%'. $this->search .'%')
        ->orWhere('fecha','like','%'. $this->search .'%')
        ->orWhere('comments','like','%'. $this->search .'%')
        // ->orWhere('users.name','like','%'. $this->search .'%')
        ->select('purchases.*')
        ->orderBy('id','desc')
        ->paginate(25);
        return view('livewire.admin.purchases.lista',compact('purchases'));
    }
}

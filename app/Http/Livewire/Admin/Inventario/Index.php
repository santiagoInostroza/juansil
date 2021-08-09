<?php

namespace App\Http\Livewire\Admin\Inventario;

use App\Models\Product;
use Livewire\Component;

class Index extends Component{

    public $mostrarTodosLosProductos = true;
    public $search;
    public $order_by = "name";
    public $asc = 'asc';
    
    public function render(){

        $str = explode(' ', $this->search);

        $products = Product::where(function($query) use($str) {
            foreach($str as $s) {
                $query = $query->where('products.name','like',"%" . $s . "%");
            }
        })
        ->orderBy($this->order_by,$this->asc)->get();;

        return view('livewire.admin.inventario.index',compact('products'));
    }
}

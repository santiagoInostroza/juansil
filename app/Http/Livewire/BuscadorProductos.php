<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CarritoController;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;

class BuscadorProductos extends Component{

    public $search;
    public $searchIsOpen = false;
    public $type_selected = 1;
    public $cantidad = 1;
    public $prueba = 'hola';


    public function render(){
       

      
            $str = explode(' ', $this->search);

            $products = Product::where(function($query) use($str) {
                foreach($str as $s) {
                    $query = $query->where('name','like',"%" . $s . "%");
                }
            })
            ->get();

            $tags = Tag::where(function($query) use($str) {
                foreach($str as $s) {
                    $query = $query->where('name','like',"%" . $s . "%");
                }
            })
            ->get();

            

                
        


        return view('livewire.buscador-productos', compact('products','tags'));
    }

    public function aumentar($product_id,$cantidad){
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Cantidad aumentada Total '". $cantidad,
            'icon' => 'success',
            'title' => "Cantidad aumentada Total '". $cantidad,
        ]); 

        session('carrito')[$product_id]['cantidad'] = $cantidad;
        

        // $carrito = new CarritoController();
        // $carrito->setCantidad($product_id,$cantidad);
    }
}

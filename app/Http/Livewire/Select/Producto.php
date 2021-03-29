<?php

namespace App\Http\Livewire\Select;

use App\Models\Product;
use Livewire\Component;

class Producto extends Component
{
    public $indice;
    public $query = "";
    public $product_id;
    public $nombreProducto;
    public $showList = false;
    public $showCreateProduct = false;
    public $productos = "";
    public $index =0;
    protected $listeners=['setProductId','showCreateProduct'];

    
  
    public function render(){ 
        $productos = Product::where("name","like", "%". $this->query ."%")->get();
        $this->productos = $productos;
        return view('livewire.select.producto',compact('productos'));
    }


    public function marcarSeleccion($id){
        $this->index = $id;
    }

    public function setProductId($id, $nombreProducto){  
        $this->product_id = $id;
        $this->query = $nombreProducto;
        $this->showList= false;
        $this->emitUp('setProductId',$this->product_id);
    }
    
    public function incrementIndex(){
        if (count($this->productos) == 0) {
            $this->index=1;
        }else{            
            $this->index++;
            if( $this->index > count($this->productos) ){
                $this->index = 1;
            }
        }
    }

    public function decrementIndex(){
        if (count($this->productos) == 0) {
            $this->index=1;
        }else{ 
            $this->index--;
            if( $this->index <= 0 ){
                $this->index = count($this->productos);
            } 
        }       
    }

    public function seleccionarOpcion(){   
        if (count($this->productos) == 0 && $this->index==1) {
           
            $this->showCreateProduct = true;
        } else {
            $this->product_id = $this->productos[$this->index-1]['id'];
            $this->query = $this->productos[$this->index-1]['name'];
            $this->emitUp('setProductId',$this->product_id);
        }
        
       
    }

    public function showCreateProduct(){
        $this->showCreateProduct = true;
    }

   
}

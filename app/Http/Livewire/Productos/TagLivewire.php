<?php

namespace App\Http\Livewire\Productos;

use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;

class TagLivewire extends Component{

    public $tag;
    protected $listeners = (['render','setCantidad','addToCart','removeFromCart2','buscar']);


    public function render(){
        $products = Product::join('product_tag','products.id','=','product_tag.product_id')
        ->where('product_tag.tag_id', $this->tag->id)
        ->select('products.*')
        ->get();

        $tags = Tag::with('products')->where('id', '!=', $this->tag->id )->get();


        return view('livewire.productos.tag-livewire', compact('products','tags'));
    }
}

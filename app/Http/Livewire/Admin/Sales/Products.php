<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Product;
use Livewire\Component;

class Products extends Component{
    public $search;
    public $view = 2;

    public function render(){

        $products = Product::where('name' , 'like' ,  '%' . $this->search . '%' )->get();
        return view('livewire.admin.sales.products',compact('products'));
    }

    public function addToSale($id, $quantity, $price){
        $product = Product::find($id);

        $items = [];
        if (session()->has('venta.items')) {
            $items = session('venta.items');
        }


        $items[] =
            [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'image' => $product->image->url,
                'cantidad' =>1,
                'cantidad_por_caja' => $quantity,
                'cantidad_total' => $quantity,
                'precio' => $price,
                'precio_por_caja' => $quantity * $price,
                'precio_total' =>$quantity * $price ,
            ];

        session([
            'venta.items' => $items
        ]);

        $total = 0;
        foreach (session('venta.items') as  $value) {
            $total += $value['precio_total'];
        }


        session([
            'venta.total' => $total
        ]);
        $this->emitTo('admin.sales.pending-orders', 'render');
    }
}

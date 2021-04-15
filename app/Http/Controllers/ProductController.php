<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller{
   

    public function index(){
        return view('products.index');
    }




    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show(Product $producto){
        $this->authorize('published',$producto);
        
        $misma_categoria = Product::where('category_id', $producto->category_id)
            ->where('id', '!=', $producto->id)
            ->take(4)
            ->get();
        $misma_marca = Product::where('brand_id', $producto->brand_id)
        ->where('id', '!=',$producto->id)
        ->take(4)
        ->get();

        return view('products.show', compact('producto', 'misma_categoria', 'misma_marca'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


    public function pay(Product $product){
        return view('products.pay',compact('product'));
    }
}

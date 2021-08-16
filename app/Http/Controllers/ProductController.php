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

    public function lista(){
      
        return view('products.lista');
    }

    public function specialPrice(){
      
        return view('products.specialPrice');
    }




    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show(Product $producto){
        $this->authorize('published',$producto);
        
      

        return view('products.show', compact('producto'));
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

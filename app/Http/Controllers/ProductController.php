<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller{
   

    public function index(){
        
        
        if (Auth::check()) {
            $customer = Customer::where('email',Str::lower(Auth::user()->email) )->first();
            if ( $customer){
                if($customer->user_id){
                    return view('products.index');
                }else{
                    $customer->user_id = Auth::user()->id;
                    $customer->save();
                   echo " <div class='p-4 bg-red-500 text-white font-bold fixed top-0 h-26 left-0 right-0 z-10'> <div class='text-xl '>Bienvenido " . Auth::user()->name .  ".</div>  Hemos vinculadotu cuenta de cliente a la cuenta de usuario que acabas de registrar. Ahora podrás ver todas las compras que has realizado y tener un seguimiento detallado de tus movimientos</div> <div class='mt-26'></div> " ;
                  
                }

            } 
            return view('products.index');
        }else{
            return view('products.index');
        }
        return view('products.index');
    }

    public function lista(){   
        return view('products.lista');
    }

    public function specialPrice(){
        return view('products.specialPrice');
    }

    public function orders(){
     
        return view('products.orders');
    }
  

    public function category(Category $category){ 
        return view('products.category',compact('category'));
    }

    public function tag(Tag $tag){ 
        return view('products.tag',compact('tag'));
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

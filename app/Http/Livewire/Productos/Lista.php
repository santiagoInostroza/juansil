<?php

namespace App\Http\Livewire\Productos;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Lista extends Component{
    public $productos;
    public $destacados;
    
    public function render(){

        $this->getCache();
        $productos = $this->productos;
        $destacados = $this->destacados;

        return view('livewire.productos.lista', compact('productos','destacados'));
    }


    public function deleteCache(){
        $value = Cache::pull('key');
        $value = Cache::pull('destacados');
    }

    public function getCache(){
        $seconds = 60;

        if (request()->page) {
           $key = 'productos'. request()->page;
        } else {
            $key = 'productos';
        }

        $this->productos = Cache::remember($key, $seconds, function () {
            return Product::where('status', 1)->paginate(60);
        });

        $this->destacados = Cache::remember('destacados', $seconds, function () {
            return Product::where('status', 1)->take(15)->get();
        });
           
    }

    public function filtro($name){
         $productos = Product::where('status', 1)->where('name', 'like',"%". $name . "%")->paginate(100);
         $destacados = Product::where('status', 1)->take(10)->get();

         return view('products.index', compact('productos','destacados','name'));
    }


    
    public function category(Category $category){
        $data=$category;
        $products = Product::where('category_id',$category->id)
        ->where('status',1)
        ->latest('id')
        ->paginate(6);

       return view('products.products',compact('products','data'));
    }

    public function tag(Tag $tag){
        $data=$tag;
        $products = $tag->products()->where('status',1)->latest('id')->paginate(4);
        return view('products.products',compact('products','data'));
    }

}

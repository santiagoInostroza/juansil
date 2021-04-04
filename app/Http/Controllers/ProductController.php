<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public $productos;
    public $destacados;

    public function index(){
        $this->getCache();
        $productos = $this->productos;
        $destacados = $this->destacados;
        return view('products.index', compact('productos','destacados'));
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
            return Product::where('status', 1)->paginate(32);
        });

        $this->destacados = Cache::remember('destacados', $seconds, function () {
            return Product::where('status', 1)->take(10)->get();
        });
           
    }

    public function filtro($name){
         $productos = Product::where('status', 1)->where('name', 'like',"%". $name . "%")->paginate(100);
         $destacados = Product::where('status', 1)->take(10)->get();

         return view('products.index', compact('productos','destacados','name'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $producto)
    {
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

    public function category(Category $category)
    {
        $data=$category;
        $products = Product::where('category_id',$category->id)
        ->where('status',1)
        ->latest('id')
        ->paginate(6);

       return view('products.products',compact('products','data'));
    }

    public function tag(Tag $tag)
    {
        $data=$tag;
        $products = $tag->products()->where('status',1)->latest('id')->paginate(4);
        return view('products.products',compact('products','data'));
    }

    public function pay(Product $product)
    {
        return view('products.pay',compact('product'));
    }
}

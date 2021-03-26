<?php

namespace App\Http\Controllers\Admin;

use Svg\Tag\Image;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SalePrice;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $brand = Brand::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        return view('admin.products.create', compact('categories', 'tags', 'brand'));
    }


    public function store(PostRequest $request)
    {
     
        $producto = Product::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('products', $request->file('file'),'public');
            $producto->image()->create([
                'url' => $url
            ]);
        }

        if ($request->quantity) {
            $producto->salePrices()->delete();
            for ($i = 0; $i < count($request->quantity); $i++) {
                $producto->salePrices()->create([
                    'quantity' => $request->quantity[$i],
                    'price' => $request->price[$i],
                    'total_price' => $request->total_price[$i],
                ]);
            }
        }


        if ($request->tags) {
            $producto->tags()->attach($request->tags);
        }
        return redirect()->route('admin.products.edit', $producto)->with('info', "Producto '$producto->name' creado correctamente");
    }


    public function show(Product $producto)
    {
        return view('admin.products.show', compact('producto'));
    }


    public function edit(Product $producto)
    {

        $categories = Category::pluck('name', 'id');
        $brand = Brand::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        return view('admin.products.edit', compact('producto', 'categories', 'tags', 'brand'));
    }


    public function update(PostRequest $request, Product $producto){

        //return $request->all();
        $producto->update($request->all());

        if ($request->file('file')) {

            $url = Storage::put('products', $request->file('file'));

            if ($producto->image) {
                Storage::delete($producto->image->url);

                $producto->image->update([
                    'url' => $url
                ]);
            } else {
                $producto->image()->create([
                    'url' => $url
                ]);
            }
        }


        $producto->salePrices()->delete();
        if ($request->quantity) {
            for ($i = 0; $i < count($request->quantity); $i++) {
                $producto->salePrices()->create([
                    'quantity' => $request->quantity[$i],
                    'price' => $request->price[$i],
                    'total_price' => $request->total_price[$i],
                    'special_price' =>( $request->special_price[$i] == 1 )?"1":"0",
                ]);
            }
        }



        if ($request->tags) {
            $producto->tags()->sync($request->tags);
        }

        return redirect()->route('admin.products.edit', $producto)->with('info', "Producto '$producto->name' Se actualizó correctamente");
    }


    public function destroy(Product $producto)
    {
        $nombre = $producto->name;
        $producto->delete();
        return redirect()->route('admin.products.index')->with('info', "Producto '$nombre' eliminado correctamente");
    }


  

}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index',compact('brands'));
    }
    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:brands',
        ]);
        $brands = Brand::create($request->all());
        return redirect()->route('admin.brands.index')->with('info','Se creó Marca');

    }
    public function show(Brand $marca)
    {
        
    }

    public function edit(Brand $marca)
    {
        return view('admin.brands.edit',compact('marca'));
    }

    public function update(Request $request, Brand $marca)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>"required|unique:brands,slug,$marca->id",
        ]);
        $marca->update($request->all());
        return redirect()->route('admin.brands.edit',$marca)->with('info','Se actualizó Marca');
    }
    public function destroy(Brand $marca)
    {
       $marca->delete();
       return redirect()->route('admin.brands.index')->with('eliminado','ok');
    }

    public function saveNewBrand($nameBrand){

        $brand = Brand::where('name',$nameBrand)->first();

        if($nameBrand=="" || $brand){
            return 0;
        }
        
        $brand = new Brand();
        $brand->name = $nameBrand;
        $brand->slug = Str::slug($nameBrand);
        $brand->save();
        return $brand->id;
        
    }
}

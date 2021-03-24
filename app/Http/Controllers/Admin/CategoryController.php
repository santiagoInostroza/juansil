<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories= Category::all();
        return view('admin.categories.index',compact('categories'));
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories',
        ]);
       
        $category = Category::create($request->all());

        return redirect()->route('admin.categories.index',$category)->with('info','La categoria se creó');
    }

    public function show(Category $categoria ){
        return view('admin.categories.show',compact('categoria'));
    }

    public function edit(Category $categoria){
        return view('admin.categories.edit',compact('categoria'));
    }


    public function update(Request $request, Category $categoria)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>"required|unique:categories,slug,$categoria->id",
        ]);
            $categoria->update($request->all());

            return redirect()->route('admin.categories.edit',$categoria)->with('info','La categoria se actualizó');
    }


    public function destroy(Category $categoria)
    {
       
        $categoria->delete();
        return redirect()->route('admin.categories.index')->with('eliminado','ok');
    }
}

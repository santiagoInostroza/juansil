<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tags = Tag::all();
       return view('admin.tags.index',compact('tags'));
    }
    public function create()
    {

        $colors=[
            ''=>'Selecciona color',
            'red'=>'Rojo',
            'yellow'=>'Amarillo',
            'green'=>'Verde',
            'blue'=>'Azul',
            'indigo'=>'Indigo',
            'purple'=>'Morado',
            'pink'=>'Rosado',
        ];
        return view('admin.tags.create',compact('colors'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:tags',
            'color'=>'required|unique:tags',
        ]);
        $tags = Tag::create($request->all());
        return redirect()->route('admin.tags.index',$tags)->with('info','Se creó Etiqueta');
    }

    public function show(Tag $etiqueta)
    {
        return view('admin.tags.show',compact('etiqueta'));
    }

    public function edit(Tag $etiqueta)
    {
        $colors=[
            ''=>'Selecciona color',
            'red'=>'Rojo',
            'yellow'=>'Amarillo',
            'green'=>'Verde',
            'blue'=>'Azul',
            'indigo'=>'Indigo',
            'purple'=>'Morado',
            'pink'=>'Rosado',
        ];
        return view('admin.tags.edit',compact('etiqueta','colors'));
    }

    public function update(Request $request,Tag $etiqueta)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>"required|unique:tags,slug,$etiqueta->id",
            'color'=>'required|unique:tags',
        ]);
        $etiqueta->update($request->all());
        return redirect()->route('admin.tags.edit',$etiqueta)->with('info','Se actualizó etiqueta');
    }

    public function destroy(Tag $etiqueta)
    {
        $etiqueta->delete();
        return redirect()->route('admin.tags.index')->with('eliminado','ok');
    }
}

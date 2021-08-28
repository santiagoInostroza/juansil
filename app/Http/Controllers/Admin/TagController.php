<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller{

    public function index(){
       $tags = Tag::all();
       return view('admin.tags.index',compact('tags'));
    }

    public function create(){

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

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:tags',
            'color'=>'required',
        ]);
        $tags = Tag::create($request->all());
        return redirect()->route('admin.tags.index',$tags)->with('info','Se creó Etiqueta');
    }

    public function saveNewTag($newTag) {
        // requires name|type
        $tag = Tag::where('name',$newTag['name'])->first();

        if(!$tag){
            $tag = new Tag();
            $tag->name = $newTag['name'];
            $tag->slug = Str::slug($newTag['name']);
            $tag->type = Str::slug($newTag['type']);
            switch ($newTag['type']) {
                case '1':
                    $tag->color = 'indigo' ;
                    break;
                case '2':
                    $tag->color = 'pink' ;
                    break;
                case '3':
                    $tag->color = 'green' ;
                    break;
                default:
                    $tag->color = 'indigo' ;
                    break;
            }
            $tag->save();
            return $tag->id;
        }else{
            return 0;
        }
        
    }

    public function show(Tag $etiqueta){
        return view('admin.tags.show',compact('etiqueta'));
    }

    public function edit(Tag $etiqueta){
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
            'color'=>'required',
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

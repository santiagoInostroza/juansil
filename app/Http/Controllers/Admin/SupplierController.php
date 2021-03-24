<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
       
        return view('admin.suppliers.index', compact('supplier'));
    }
    
    public function create()
    {
        return view('admin.suppliers.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:suppliers',
        ]);

        $proveedor = Supplier::create($request->all());
        return redirect()->route('admin.suppliers.edit',$proveedor)->with('info',"Proveedor '$proveedor->name' creado con exito ");

    }
    
    public function show(Supplier $proveedore)
    {
        //
    }
    
    public function edit(Supplier $proveedore)
    {
        return view('admin.suppliers.edit',compact('proveedore'));
    }

    public function update(Request $request, Supplier $proveedore)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>"required|unique:suppliers,slug,$proveedore->id",
        ]);
            $proveedore->update($request->all());

            return redirect()->route('admin.suppliers.edit',$proveedore)->with('info',"El proveedor '$proveedore->name' se actualizó correctamente");
    }
    
    public function destroy(Supplier $proveedore)
    {
        $nombre= $proveedore->name;
       $proveedore->delete();
       return redirect()->route('admin.suppliers.index')->with('info',"Proveedor '$nombre' eliminado correctamente");
    }
}

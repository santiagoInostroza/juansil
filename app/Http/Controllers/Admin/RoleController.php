<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    
    
    public function index()
    {
        $roles = Role::all();
       return view('admin.roles.index',compact('roles'));
    }
    
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'name'=>'required'
        ]);

        $role = Role::create($request->all());

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit',$role)->with('info','El rol se creó con exito');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show',compact('role'));
    }
    
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit',$role)->with('info','El rol se actualizó con exito');
     
    }
    
    public function destroy(Role $role)
    {
       $name = $role->name;
       $role->delete();
       return redirect()->route('admin.roles.index')->with('info','El rol "'. $name . '" se eliminó con exito');
    }


    public function permission(){


        return view('admin.roles.permission');
    }

}

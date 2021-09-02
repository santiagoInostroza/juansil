<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller{

    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
    }
    
    public function index(){
       return view('admin.users.index');
    }
    public function newIndex(){
       return view('admin.users.newIndex');
    }

    public function edit(User $user){
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user){
       $user->roles()->sync($request->roles);
       return redirect()->route('admin.users.edit',$user)->with('info','Se asignó los roles correctamente');
    }
    
    public function saveRole($user_id,$role_id){
        if($role_id>0){
            $user= User::find($user_id);
            if( !$user->roles->contains('id',$role_id)){
                $user->roles()->attach($role_id);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function removeRole($user_id,$role_id){
        $user= User::find($user_id);
        if($user){
            $user->roles()->detach($role_id);
            return true;
        }
        return false;
        
    }

    



}

<?php

namespace App\Http\Controllers\Admin2;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller{

    public function index(){
        return view('admin2.users.index');
    }

   
    public function create(){
        //
    }

    
    public function store(Request $request){
        
    }

 
    public function show($id){
        //
    }

    public function edit(User $user){
       return view('admin2.users.edit',compact('user'));
    }

  
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

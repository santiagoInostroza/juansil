<?php

namespace App\Http\Controllers\Admin2;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller{

    public function __construct(){

        $this->middleware('auth');
        $this->middleware('can:admin.roles.index')->only('index');
        $this->middleware('can:admin.roles.create')->only('create');
        $this->middleware('can:admin.roles.show')->only('show');
        $this->middleware('can:admin.roles.edit')->only('edit');
        // $this->middleware('subscribed')->except('store');

    }

    public function index(){
        return view('admin2.roles.index');
    }

    public function create(){
        return view('admin2.roles.create');
    }

    public function store(Request $request){
        //
    }

    
    public function show(Role $role){
        return view('admin2.roles.show',compact('role'));
    }


    public function edit(Role $role){
        return view('admin2.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

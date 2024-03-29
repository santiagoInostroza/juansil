<?php

namespace App\Http\Controllers\Admin2;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller{

    public function __construct(){

        $this->middleware('auth');
        $this->middleware('can:admin.suppliers.index')->only('index');
        $this->middleware('can:admin.suppliers.create')->only('create');
        $this->middleware('can:admin.suppliers.show')->only('show');
        $this->middleware('can:admin.suppliers.edit')->only('edit');
        // $this->middleware('subscribed')->except('store');

    }
   
    public function index(){
      return view('admin2.suppliers.index');
    }

    public function create(){
        return view('admin2.suppliers.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show($id){
        
    }

    public function edit(Supplier $supplier){
        return view('admin2.suppliers.edit', compact('supplier'));
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

<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller{

    public function __construct(){

        $this->middleware('auth');
        $this->middleware('can:admin.sales.index')->only('index');
        $this->middleware('can:admin.sales.create')->only('create');
        $this->middleware('can:admin.sales.show')->only('show');
        $this->middleware('can:admin.sales.edit')->only('edit');
        // $this->middleware('subscribed')->except('store');

    }


    public function index(){
      return view('admin2.sales.index');
    }
    
    public function create(){
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
       return view('admin2.sales.edit');
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

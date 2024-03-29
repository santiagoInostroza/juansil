<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('can:admin.purchases.index')->only('index');
        $this->middleware('can:admin.purchases.create')->only('create');
        $this->middleware('can:admin.purchases.show')->only('show');
        $this->middleware('can:admin.purchases.edit')->only('edit');
        // $this->middleware('subscribed')->except('store');

    }

    public function index(){
       return view('admin2.purchases.index');
    }

    public function create(){
        return view('admin2.purchases.create');
    }

    public function store(Request $request){
      
    }

    public function show(Purchase $purchase){
        return view('admin2.purchases.show',[
            'purchase' => $purchase
        ]);
    }

    public function edit(Purchase $purchase){
        return view('admin2.purchases.edit',[
            'purchase' => $purchase
        ]);
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){
       
        
    }
}

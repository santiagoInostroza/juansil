<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchasePrice;

class StockController extends Controller
{
    public function index()
    {
        $products = PurchasePrice::all();
       
        return view('admin.stock.index', compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }
    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
     
    }
}

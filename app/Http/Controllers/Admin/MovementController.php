<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductMovement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    
    public function index()
    {
        $movements = ProductMovement::all();
       
        return view('admin.movements.index', compact('movements'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }
    
    public function show(ProductMovement $movimiento)
    {
        //
    }

    
    public function edit(ProductMovement $movimiento)
    {
        //
    }

    
    public function update(Request $request, ProductMovement $movimiento)
    {
        //
    }

    
    public function destroy(ProductMovement $movimiento)
    {
        //
    }
}

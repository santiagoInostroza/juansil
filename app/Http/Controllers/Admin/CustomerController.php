<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\CustomerData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return view("admin.customers.index", compact('customers'));
    }


    public function create()
    {
        return view("admin.customers.create");
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        
       $customer_data = CustomerData::create([
        'total_credito' => 0,
        ]);

        $customer = Customer::create($request->all());
        $customer->customer_data_id = $customer_data->id;
        $customer->save();

        return redirect()->route('admin.customers.edit',$customer)->with('info', "Cliente '$customer->name 'creado correctamente");

    }

    public function show(Customer $cliente){
       return $cliente;
    }

    public function showCustomerData(Customer $cliente){
       return view("admin.customers.datos_cliente", compact('cliente'));
    }

    public function edit(Customer $cliente){
        return view("admin.customers.edit", compact('cliente'));
    }

    public function update(Request $request, Customer $cliente){
        $request->validate([
            'name' => 'required',
        ]);
        $cliente->update($request->all());

        return redirect()->route('admin.customers.edit',$cliente)->with('info', "Cliente '$cliente->name 'Actualizado correctamente");
    }

    
    public function destroy(Customer $cliente)
    {
       $cliente->delete();
       
       return redirect()->route('admin.customers.index')->with('eliminado','ok');
    }
}

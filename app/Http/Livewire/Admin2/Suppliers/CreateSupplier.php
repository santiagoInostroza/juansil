<?php

namespace App\Http\Livewire\Admin2\Suppliers;

use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Support\Str;

class CreateSupplier extends Component{
    public $name;

    protected $rules=[
        'name' => 'required',
    ];

    protected $messages=[
        'name.required' => 'Ingresa un nombre para el proveedor',
    ];

    public function render(){
        return view('livewire.admin2.suppliers.create-supplier');
    }

    public function createSupplier(){
        $this->validate();

        $supplier = Supplier::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('message','Proveedor '. $supplier->name . ' creado correctamente!!');
        return redirect()->route('admin2.suppliers.edit',$supplier);



        
    }
}

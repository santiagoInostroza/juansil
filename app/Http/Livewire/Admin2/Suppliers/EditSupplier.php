<?php

namespace App\Http\Livewire\Admin2\Suppliers;

use Livewire\Component;

class EditSupplier extends Component{

    public $supplier;
    public $name;

    protected $rules=[
        'supplier.name' => 'required',
    ];

    protected $messages=[
        'supplier.name.required' => 'Ingresa un nombre para el proveedor',
    ];

    public function render(){
        return view('livewire.admin2.suppliers.edit-supplier');
    }

    public function updateSupplier(){
       $this->validate();
       $this->supplier->save();

       session()->flash('message','Proveedor '. $this->supplier->name . ' actualizado correctamente!!');
        return redirect()->route('admin2.suppliers.edit',$this->supplier);
    }
}

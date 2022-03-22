<?php

namespace App\Http\Livewire\Admin2\Suppliers;

use App\Models\Supplier;
use Livewire\Component;

class IndexSuppliers extends Component{

    public function render(){
        return view('livewire.admin2.suppliers.index-suppliers',[
            'suppliers' => Supplier::all(),
        ]);
    }

    public function deleteSupplier($supplier_id){
        $supplier = Supplier::find($supplier_id);
        $supplier->delete();

        session()->flash('message','Proveedor '. $supplier->id . ' Eliminado correctamente!!');
        return redirect()->route('admin2.suppliers.index');

    }
}

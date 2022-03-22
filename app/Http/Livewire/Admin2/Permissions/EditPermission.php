<?php

namespace App\Http\Livewire\Admin2\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class EditPermission extends Component{
    public $permission;
    public $name;
    public $description;

    public function mount(){
    }

    protected $rules=[
        'permission.name' => 'required',
        'permission.description' => 'required',
    ];

    protected $messages=[
        'permission.name.required' => 'Ingresa un nombre para este permiso',
        'permission.description.required' => 'Ingresa una breve descripcion para este permiso',
    ];
    

    public function render()    {
        return view('livewire.admin2.permissions.edit-permission');
    }

    public function updatePermission(){
        $this->validate();
        $this->permission->save();

        session()->flash('message','Permiso '. $this->permission->id . ' editado correctamente!!');
        return redirect()->route('admin2.permissions.index');



        
        
    }
}

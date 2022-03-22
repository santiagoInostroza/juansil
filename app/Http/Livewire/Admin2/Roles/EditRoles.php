<?php

namespace App\Http\Livewire\Admin2\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EditRoles extends Component{
    public $role;

    public $name;
    public $permissions;

    protected $rules = [
        'role.name'=>'required',
        'permissions'=>'required',
    ];
    protected $messages = [
        'role.name.required'=>'Ingresa un nombre de rol para crear uno',
        'permissions.required'=>'Selecciona por lo menos un permiso',
    ];

    public function mount(){
        $this->permissions = $this->role->permissions->pluck('id');
    }

    public function render(){
        return view('livewire.admin2.roles.edit-roles',[
            'allPermissions' => Permission::all(),
        ]);
    }

    public function editRol(){
        $this->validate();
         $this->role->save();

        $this->role->syncPermissions($this->permissions);

        session()->flash('message','Rol '. $this->role->name . ' editado correctamente!!');
        return redirect()->route('admin2.roles.index');

    }
}

<?php

namespace App\Http\Livewire\Admin2\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRoles extends Component{
    public $name;
    public $permissions;

    protected $rules = [
        'name'=>'required',
        'permissions'=>'required',
    ];
    protected $messages = [
        'name.required'=>'Ingresa un nombre de rol para crear uno',
        'permissions.required'=>'Selecciona por lo menos un permiso',
    ];

    public function mount(){
        $this->permissions = [];
    }

    public function render(){

        return view('livewire.admin2.roles.create-roles',[
            'allPermissions' => Permission::all(),
        ]);


    }

    public function saveRol(){
        $this->validate();
       $role = Role::create([
            'name' => $this->name
        ]);

        $role->syncPermissions($this->permissions);

        session()->flash('message','Rol '. $role->name . ' creado correctamente!!');
        return redirect()->route('admin2.roles.index');

    }


}

<?php

namespace App\Http\Livewire\Admin2\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class CreatePermission extends Component{
    public $name;
    public $description;

    public function mount(){
        $this->name="";
        $this->description="";
    }

    protected $rules=[
        'name' => 'required',
        'description' => 'required',
    ];

    protected $messages=[
        'name.required' => 'Ingresa un nombre para este permiso',
        'description.required' => 'Ingresa una breva descripcion para este permiso',
    ];
    
    public function render(){
        return view('livewire.admin2.permissions.create-permission');
    }

    public function createPermission(){
        $this->validate();

        $permission = Permission::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $permission->assignRole('SuperAdmin');

        session()->flash('message','Permiso '. $permission->id . ' creado correctamente!!');
        return redirect()->route('admin2.permissions.index');



        
        
    }
}

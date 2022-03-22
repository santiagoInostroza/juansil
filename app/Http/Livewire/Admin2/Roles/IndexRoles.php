<?php

namespace App\Http\Livewire\Admin2\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class IndexRoles extends Component{
    public function render(){
        
        return view('livewire.admin2.roles.index-roles',[
            'roles' => Role::all()
        ]);
    }

    public function deleteRole($role_id){
        $role =  Role::find($role_id);
        $role->delete();

        session()->flash('message','Rol '. $role_id . ' Eliminado correctamente!!');
        return redirect()->route('admin2.roles.index');
    }


}

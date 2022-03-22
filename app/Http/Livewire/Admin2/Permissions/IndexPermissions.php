<?php

namespace App\Http\Livewire\Admin2\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class IndexPermissions extends Component{
    public $search;

    public function render(){
    
        return view('livewire.admin2.permissions.index-permissions',[
            'permissions' => Permission::
            where('name','like','%'. $this->search . '%')
            ->orWhere('description','like','%'. $this->search . '%')
            ->get(),
        ]);
    }

    public function deletePermission($permission_id){
        $permission =  Permission::find($permission_id);
        $permission->delete();

        session()->flash('message','Permiso '. $permission->id . ' Eliminado correctamente!!');
        return redirect()->route('admin2.permissions.index');
    }
}

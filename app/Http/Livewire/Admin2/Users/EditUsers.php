<?php

namespace App\Http\Livewire\Admin2\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditUsers extends Component{
    public $user;
    public $roles;




    public function mount(){
        $this->roles = $this->user->roles->pluck('name');
    }


    public function render(){
        return view('livewire.admin2.users.edit-users',[
            'allRoles' => Role::all(),
        ]);
    }

    public function updateUserRole(){
        $this->user->syncRoles($this->roles);

        session()->flash('message','Rol de usuario  actualizado correctamente!!');
        return redirect()->route('admin2.users.index');

    }
}

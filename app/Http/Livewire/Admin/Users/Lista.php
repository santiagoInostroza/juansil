<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class Lista extends Component{
    use WithPagination;

    public $search;
    public $editRow;
    public $rowTrue;
    public $editRowVerify = true;

    public function render(){

        $users = User::with('customers')->where('name', 'like', '%'. $this->search . '%')->get();
        foreach ($users as  $user) {
           $this->editRow[$user->id] = false;
        }

        if($this->editRowVerify){
            if ( $this->rowTrue) {
                $this->editRow[$this->rowTrue] = true;
            }
        }

        $roles = Role::all();


        return view('livewire.admin.users.lista',compact('users','roles'));
    }

    public function editRowTrue($user_id){
        $this->editRow[$this->rowTrue] = false;
        $this->editRow[$user_id] = true;
        $this->rowTrue = $user_id;
        $this->editRowVerify = true;
        
    }
   
}

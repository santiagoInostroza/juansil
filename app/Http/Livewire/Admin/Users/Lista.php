<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

class Lista extends Component{
    use WithPagination;

    public $search;
    public $editRow;
    public $rowSelected;
    public $showInfo;
    public $showInfoTrue;

    public $editRowVerify = true;

    public function render(){

        $users = User::with('customers')->where('name', 'like', '%'. $this->search . '%')->get();
        foreach ($users as  $user) {
           $this->editRow[$user->id] = false;
           $this->showInfo[$this->rowSelected] = false;
        }

        if($this->editRowVerify){
            if ( $this->rowSelected) {
                $this->editRow[$this->rowSelected] = true;

                if ( $this->showInfoTrue) {
                    $this->showInfo[$this->rowSelected] = true;
                }
            }
           
        }
       

        $roles = Role::all();


        return view('livewire.admin.users.lista',compact('users','roles'));
    }

    public function editRowTrue($user_id){
        $this->editRow[$this->rowSelected] = false;
        $this->editRow[$user_id] = true;
        $this->rowSelected = $user_id;
        $this->editRowVerify = true;
        $this->showInfoTrue = false;
    }

 

    public function saveUserRole($user_id,$role_id){
       $userController = new UserController();
       $userController->saveUserRole($user_id,$role_id);
    }

    public function removeUserRole( $user_id,$role_id){
        $userController = new UserController();
        $userController->removeUserRole( $user_id,$role_id);
       
    }
   
}

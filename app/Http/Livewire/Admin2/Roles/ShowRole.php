<?php

namespace App\Http\Livewire\Admin2\Roles;

use Livewire\Component;

class ShowRole extends Component{
    public $role;
    public function render(){

        return view('livewire.admin2.roles.show-role');
    }
}

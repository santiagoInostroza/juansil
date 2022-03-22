<?php

namespace App\Http\Livewire\Admin2\Users;

use App\Models\User;
use Livewire\Component;

class IndexUsers extends Component{

    public function render(){
        return view('livewire.admin2.users.index-users',[
            'users' => User::all(),
        ]);
    }
}

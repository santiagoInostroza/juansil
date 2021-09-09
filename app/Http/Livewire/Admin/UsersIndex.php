<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\UserCount;
use Livewire\Component;

use Livewire\WithPagination;

class UsersIndex extends Component{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }


    public function render()
    {


        $userCounts = UserCount::orderBy('dateModificate','desc')->orderBy('dateCreate','desc')->get();


        $users = User::where('name', 'like', '%'. $this->search .'%')->orWhere('email', 'like', '%'. $this->search .'%')->paginate();
        
        return view('livewire.admin.users-index',compact('users','userCounts'));
    }
}

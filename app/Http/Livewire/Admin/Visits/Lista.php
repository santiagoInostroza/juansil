<?php

namespace App\Http\Livewire\Admin\Visits;

use Livewire\Component;
use App\Models\UserCount;

class Lista extends Component{
    
    public function render(){
        $userCounts = UserCount::orderBy('date','desc')->where('countryName','Chile')->orderBy('dateModificate','desc')->orderBy('dateCreate','desc')->get();
        $userCountsTotalDistinct = UserCount::distinct()->count('ip');
        $userCountsChile = UserCount::where('countryName','Chile')->distinct()->count('ip');
        return view('livewire.admin.visits.lista',compact('userCounts','userCountsTotalDistinct','userCountsChile'));
    }
}

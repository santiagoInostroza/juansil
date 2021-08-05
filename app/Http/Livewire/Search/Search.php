<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;

class Search extends Component
{
    public $items;
    public $idSearch;

    
    public function render()
    {
        return view('livewire.search.search');
    }
}

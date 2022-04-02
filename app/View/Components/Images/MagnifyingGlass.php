<?php

namespace App\View\Components\Images;

use Illuminate\View\Component;

class MagnifyingGlass extends Component
{

    public $url;
    public $zoom;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url,$zoom=1.7){
        $this->url = $url;
        $this->zoom = $zoom;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render(){

        return view('components.images.magnifying-glass');
    }
}

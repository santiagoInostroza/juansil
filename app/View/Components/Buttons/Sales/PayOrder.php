<?php

namespace App\View\Components\Buttons\Sales;

use Illuminate\View\Component;

class PayOrder extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.buttons.sales.pay-order');
    }
}

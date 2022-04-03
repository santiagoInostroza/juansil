<?php

namespace App\View\Components\Admin2\Buttons\Sales;

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
        return view('components.admin2.buttons.sales.pay-order');
    }
}

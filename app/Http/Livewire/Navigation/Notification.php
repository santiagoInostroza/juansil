<?php

namespace App\Http\Livewire\Navigation;

use Livewire\Component;

class Notification extends Component
{
    public function render()
    {
        return view('livewire.navigation.notification');
    }

    

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }
}

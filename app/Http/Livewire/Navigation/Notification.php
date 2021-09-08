<?php

namespace App\Http\Livewire\Navigation;

use Livewire\Component;

class Notification extends Component
{
    public $isOpenNotification;
    public function render()
    {
        if(auth()->user()->unreadNotifications->count()){
            $this->dispatchBrowserEvent('notification'); 
        }
        return view('livewire.navigation.notification');
    }

    

    public function markAsRead()
    {
        // auth()->user()->unreadNotifications->markAsRead();
    }

    public function openNotification()
    {
        $this->isOpenNotification = true;
    }
}

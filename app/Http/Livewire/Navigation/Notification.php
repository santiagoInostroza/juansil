<?php

namespace App\Http\Livewire\Navigation;

use Livewire\Component;

class Notification extends Component
{
    public $isOpenNotification;
    public function render(){
      
        return view('livewire.navigation.notification');
    }

    

    public function markAsRead()
    {
        // auth()->user()->unreadNotifications->markAsRead();
    }

    public function openNotification(){
        $this->isOpenNotification = true;
    }
}

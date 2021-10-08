<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Sale;
use Livewire\Component;

class Notification extends Component{

    public $isOpenNotification;
    public $isOpenSale;

    public $sale;
    

    public function mount(){
        $this->isOpenSale = false;
        
    }

    public function render(){
        return view('livewire.navigation.notification');
    }

    public function openSale($sale_id, $notification_id){
        $this->isOpenSale = true;
        $this->sale = Sale::find($sale_id);
        $this->mark_a_notification($notification_id);
      

       
    }

    public function mark_a_notification($notification_id){
        auth()->user()->unreadNotifications->when($notification_id, function($query) use($notification_id){
            return $query->where('id', $notification_id);
        })->markAsRead();      

    }
    public function setAllAsRead(){
        auth()->user()->unreadNotifications->markAsRead();


    }

    public function openNotification(){
        $this->isOpenNotification = true;
    }
}

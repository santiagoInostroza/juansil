<?php

namespace App\View\Components;


use Carbon\Carbon;
use App\Models\UserCount;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
 
        $ip =  $this->getRealIP();
        $page = Request::url();



      
        $userCounts =  UserCount::where('ip',$ip)->where('page',$page)->first();

        if($userCounts){
            $userCounts->visitas ++;
            $userCounts->dateModificate = Carbon::now()->locale('es_ES')->timezone('America/Santiago');
            $userCounts->save();
        }else{
            $userCounts = new UserCount();
            $userCounts->ip = $ip;
            $userCounts->page = $page;
            $userCounts->visitas = 1;
            $userCounts->dateCreate = Carbon::now()->locale('es_ES')->timezone('America/Santiago');

            $userCounts->save();
        }

       


        return view('layouts.app');
    }

    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }
}

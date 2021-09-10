<?php

namespace App\View\Components;


use Carbon\Carbon;
use App\Models\UserCount;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;

class AppLayout extends Component
{

    public $ip2;
    public $country;
    public $countryCode;
    public $countryAbbreviation;
    public $countryName;

    public $agent;
    public $nameNavigator;
    public $plattform;
    public $version;
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
 
        try {
            $this->getDataIp();
        } catch (\Throwable $th) {
            $this->ip2 = "-";
            $this->country = "-";
            $this->countryCode = "-";
            $this->countryAbbreviation = "-";
            $this->countryName = "-";
        }

        $this->agent  = $_SERVER['HTTP_USER_AGENT'];
        $this->version = '';
        $this->plattform = '';

        try {
            $this->nameNavigator = $this->get_browser_name($this->agent);
        } catch (\Throwable $th) {
            $this->nameNavigator = 'error'; 
        }
       

        $ip =  $this->getRealIP();
        $page = Request::url();
      
        $userCounts =  UserCount::where('ip',$ip)->where('page',$page)->first();

        if($userCounts){
            $userCounts->visitas ++;
            $userCounts->dateModificate = Carbon::now()->locale('es_ES')->timezone('America/Santiago');
            $userCounts->ip2 = $this->ip2;
            $userCounts->country = $this->country;
            $userCounts->countryCode = $this->countryCode;
            $userCounts->countryAbbreviation = $this->countryAbbreviation;
            $userCounts->countryName = $this->countryName;
            $userCounts->date = Carbon::now();
            $userCounts->agent = $this->agent;
            $userCounts->nameNavigator = $this->nameNavigator;
            $userCounts->version = $this->version;
            $userCounts->plattform = $this->plattform;

            $userCounts->save();
        }else{
            $userCounts = new UserCount();
            $userCounts->ip = $ip;
            $userCounts->ip2 = $this->ip2;
            $userCounts->country = $this->country;
            $userCounts->countryCode = $this->countryCode;
            $userCounts->countryAbbreviation = $this->countryAbbreviation;
            $userCounts->countryName = $this->countryName;
            $userCounts->page = $page;
            $userCounts->visitas = 1;
            $userCounts->dateCreate = Carbon::now()->locale('es_ES')->timezone('America/Santiago');
            $userCounts->date = Carbon::now();
            $userCounts->agent = $this->agent;
            $userCounts->nameNavigator = $this->nameNavigator;
            $userCounts->version = $this->version;
            $userCounts->plattform = $this->plattform;

            $userCounts->save();
        }

       


        return view('layouts.app');
    }

    function get_browser_name($user_agent){
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    
        return 'Other';
    }


    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }



    public function getDataIp(){
        include("geoiploc.php"); // Must include this

        // ip must be of the form "192.168.1.100"
        // you may load this from a database
        $ip = $_SERVER["REMOTE_ADDR"];
        $this->ip2= $ip;
        // echo "Your IP Address is: " . $ip . "<br />";
        
        // echo "Your Country is: ";
        // returns country code by default
        $this->country = getCountryFromIP($ip);
        
        
        // optionally, you can specify the return type
        // type can be "code" (default), "abbr", "name"
        
       
        $this->countryCode = getCountryFromIP($ip, "code");
       
        
        // print country abbreviation - case insensitive
       
        $this->countryAbbreviation = getCountryFromIP($ip, "AbBr");
       
        
        // full name of country - spaces are trimmed
       
        $this->countryName = getCountryFromIP($ip, " NamE ");
       
    }
















    
}

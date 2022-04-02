<?php

namespace App\Http\Controllers\Admin2;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller{

    public function index($period= null){
        if($period == null){
            $period = date('Y-m');
        }

        $month = date('m', strtotime($period));
        $year = date('Y', strtotime($period));
        
        $sales = Sale::distinct('user_created')->get('user_created as user')->pluck('user');
        $usersWithSales = User::whereIn('id',$sales)->get();

        return view('admin2.dashboard.index',[
            'usersWithSales' => $usersWithSales,
            'month' => $month,
            'year' => $year,
            'period' => $period,
        ]);
     }
}
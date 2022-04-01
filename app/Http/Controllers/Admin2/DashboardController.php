<?php

namespace App\Http\Controllers\Admin2;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller{

    public function index(){
        $month = 3;
        //sales distinct user_created
        $sales = Sale::distinct('user_created')->get('user_created as user')->pluck('user');
        $users = User::whereIn('id',$sales)->get();

        return view('admin2.dashboard.index',[
            'users' => $users,
            'month' => $month,
        ]);
     }
}
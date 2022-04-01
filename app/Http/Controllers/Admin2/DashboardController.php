<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index(){
        $month = 3;

        return view('admin2.dashboard.index',[
            'users' => \App\Models\User::all(),
            'month' => $month,
        ]);
     }
}
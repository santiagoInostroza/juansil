<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller{

    public function index(){

       

        return view('admin.index');
    }
}

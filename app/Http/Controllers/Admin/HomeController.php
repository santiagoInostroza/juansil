<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PurchasePrice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){

        $totalSales = Sale::sum('total');
        $totalCost = Sale::sum('total_cost');
        $diferencia = $totalSales - $totalCost;
        $porcentaje = $diferencia / $totalSales * 100;

        $totalPurchases = Purchase::sum('total');

        $inventario = PurchasePrice::sum(PurchasePrice::raw('stock * precio'));

        return view('admin.index',compact('totalSales','totalCost','diferencia','porcentaje','totalPurchases','inventario'));
    }
}

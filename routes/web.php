<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DatatableController;
use App\Http\Livewire\Cart\Carrito;
use App\Http\Livewire\Cart\Pagos;
use App\Http\Livewire\Cart\Pedido;
use App\Http\Livewire\TestApiGoogleMapsComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('productos/pedido',Pedido::class)->name('productos.pedido');
Route::get('productos/pagar',Carrito::class)->name('productos.pagar');

Route::get('/', [ProductController::class,'index'])->name('products.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('productos/busqueda/{texto}', [ProductController::class,'filtro'])->name('products.busqueda');
Route::resource('productos', ProductController::class)->names("products");
Route::get('categoria/{category}', [ProductController::class,'category'])->name('products.category');
Route::get('etiqueta/{tag}', [ProductController::class,'tag'])->name('products.tag');

Route::get('datatable/productos', [DatatableController::class,'productos'])->name('datatable.productos');
Route::get('datatable/proveedores', [DatatableController::class,'proveedores'])->name('datatable.proveedores');
Route::get('datatable/compras', [DatatableController::class,'compras'])->name('datatable.compras');
Route::get('datatable/movimientos', [DatatableController::class,'movimientos'])->name('datatable.movimientos');
Route::get('datatable/stock', [DatatableController::class,'stock'])->name('datatable.stock');
Route::get('datatable/clientes', [DatatableController::class,'clientes'])->name('datatable.clientes');
Route::get('datatable/ventas', [DatatableController::class,'ventas'])->name('datatable.ventas');


Route::post('flow', function ($id) { 
    return "PAGINA FLOW";
})->name('flow');
Route::post('flow2', function ($id) { 
    return "PAGINA flow2";
})->name('flow2');











<?php

use Illuminate\Http\Request;
use App\Http\Livewire\Admin\Home;
use App\Http\Livewire\Cart\Pagos;
use App\Http\Livewire\Cart\Pedido;
use App\Http\Livewire\Admin\Resumen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Livewire\Admin\Ventas\Venta;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DatatableController;
use App\Http\Livewire\Admin\Sales\SaleController;
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
Route::get('pedido',Pedido::class)->name('pedido');
// Route::get('productos/pagar',Carrito::class)->name('productos.pagar');

Route::get('/', [ProductController::class,'index'])->name('products.index');
Route::get('productos/lista', [ProductController::class,'lista'])->name('products.lista');
Route::get('productos/categoria/{category}', [ProductController::class,'category'])->name('products.category');
Route::get('productos/etiqueta/{tag}', [ProductController::class,'tag'])->name('products.tag');
Route::get('productos/specialPrice', [ProductController::class,'specialPrice'])->middleware('can:products.specialPrice')->name('products.specialPrice');
Route::get('Compras', [ProductController::class,'orders'])->middleware('auth')->name('orders');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('productos', ProductController::class)->names("products");
Route::get('categoria/{category}', [ProductController::class,'category'])->name('products.category');
Route::get('etiqueta/{tag}', [ProductController::class,'tag'])->name('products.tag');

Route::get('datatable/proveedores', [DatatableController::class,'proveedores'])->name('datatable.proveedores');
Route::get('test', [TestController::class,'index'])->name('test');
















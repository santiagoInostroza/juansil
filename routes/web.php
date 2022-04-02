<?php

use Illuminate\Http\Request;
use App\Http\Livewire\Admin\Home;
use App\Http\Livewire\Cart\Pagos;
use App\Http\Livewire\Cart\Pedido;
use App\Http\Livewire\Admin\Resumen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\RouteController;
use App\Http\Livewire\Admin\Ventas\Venta;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\Admin2\RoleController;
// use App\Http\Livewire\Admin\Sales\SaleController;
use App\Http\Controllers\Admin2\SaleController;
use App\Http\Controllers\Admin2\UserController;
use App\Http\Livewire\TestApiGoogleMapsComponent;
use App\Http\Controllers\Admin2\PurchaseController;
use App\Http\Controllers\Admin2\SupplierController;
use App\Http\Controllers\Admin2\DashboardController;
use App\Http\Controllers\Admin2\PermissionController;

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
Route::get('catalogo/', [ProductController::class,'lista'])->name('products.lista');
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




// ADMIN 2 //

Route::get('dashboard/{period?}', [DashboardController::class,'index'])->middleware('can:admin.dashboard.index','auth')->name('admin2.dashboard.index');
Route::get('dashboard', [DashboardController::class,'index'])->middleware('can:admin.dashboard.index','auth')->name('admin2.dashboard.index');
Route::get('fintech', [DashboardController::class,'fintech'])->middleware('can:admin.dashboard.fintech','auth')->name('admin2.dashboard.fintech');

Route::resource('admin2/roles', RoleController::class)->names('admin2.roles');

// Route::get('admin2/roles', [RoleController::class,'index'])->middleware('can:admin.roles.index')->name('admin2.roles.index');
// Route::get('admin2/roles/create', [RoleController::class,'create'])->middleware('can:admin.roles.create')->name('admin2.roles.create');
// Route::get('admin2/roles/{role}', [RoleController::class,'show'])->middleware('can:admin.roles.show')->name('admin2.roles.show');
// Route::get('admin2/roles/{role}/edit', [RoleController::class,'edit'])->middleware('can:admin.roles.edit')->name('admin2.roles.edit');

Route::resource('admin2/permisos', PermissionController::class)->names('admin2.permissions');

// Route::get('admin2/permissions', [PermissionController::class,'index'])->middleware('can:admin.permissions.index')->name('admin2.permissions.index');
// Route::get('admin2/permissions/create', [PermissionController::class,'create'])->middleware('can:admin.permissions.create')->name('admin2.permissions.create');
// Route::get('admin2/permissions/{permission}/edit', [PermissionController::class,'edit'])->middleware('can:admin.permissions.edit')->name('admin2.permissions.edit');

Route::resource('admin2/usuarios', UserController::class)->names('admin2.users');
// Route::get('admin2/users', [UserController::class,'index'])->middleware('can:admin.users.index')->name('admin2.users.index');
// Route::get('admin2/users/{user}/edit', [UserController::class,'edit'])->middleware('can:admin.users.edit')->name('admin2.users.edit');


Route::resource('admin2/proveedores', SupplierController::class)->names('admin2.suppliers');

// Route::get('admin2/proveedores', [SupplierController::class,'index'])->middleware('can:admin.suppliers.index')->name('admin2.suppliers.index');
// Route::get('admin2/proveedores/create', [SupplierController::class,'create'])->middleware('can:admin.suppliers.create')->name('admin2.suppliers.create');
// Route::get('admin2/proveedores/{supplier}/edit', [SupplierController::class,'edit'])->middleware('can:admin.suppliers.edit')->name('admin2.suppliers.edit');

Route::resource( 'admin2/ventas', SaleController::class)->names('admin2.sales');

// Route::get('admin2/sales', [SaleController::class,'index'])->middleware('can:admin.sales.index')->name('admin2.sales.index');
// Route::get('admin2/sales/create', [SaleController::class,'create'])->middleware('can:admin.sales.create')->name('admin2.sales.create');

Route::resource( 'admin2/compras', PurchaseController::class)->names('admin2.purchases');















<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Admin\ComunaController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\MovementController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\InventarioController;
use App\Http\Controllers\Admin\CustomerDataController;

Route::get('/', [HomeController::class,'index' ])->middleware('can:admin.home')->name('admin.home');

Route::resource('categorias', CategoryController::class)->middleware('can:admin.home')->names('admin.categories');
Route::resource('etiquetas', TagController::class)->middleware('can:admin.home')->names('admin.tags');
Route::resource('marcas', BrandController::class)->middleware('can:admin.home')->names('admin.brands');


Route::get('productos/newProduct/{producto}',[ProductController::class,'newProduct'])->middleware('can:admin.home')->name('admin.products.new_product');
Route::resource('productos', ProductController::class)->middleware('can:admin.home')->names('admin.products');

Route::resource('proveedores', SupplierController::class)->middleware('can:admin.home')->names('admin.suppliers');
Route::get('compras/create/{proveedor_id}', [PurchaseController::class,'create'])->middleware('can:admin.home')->name('admin.purchases.create');
Route::resource('compras', PurchaseController::class)->middleware('can:admin.home')->names('admin.purchases');

Route::get('deliveries/{date?}', [DeliveryController::class,'index'])->middleware('can:admin.home')->name('admin.deliveries.index');

Route::resource('movimientos', MovementController::class)->middleware('can:admin.home')->names('admin.movements');
Route::resource('stock', StockController::class)->middleware('can:admin.home')->names('admin.stock');
Route::get('inventory', [InventarioController::class,'index'])->middleware('can:admin.home')->name('admin.inventory');
Route::get('customer', [CustomerController::class,'index2'])->middleware('can:admin.home')->name('admin.customers.lista');
Route::resource('clientes', CustomerController::class)->middleware('can:admin.home')->names('admin.customers');
Route::get('datos-cliente/{cliente}', [CustomerController::class,'showCustomerData'])->middleware('can:admin.home')->name('admin.customers.datos_cliente');
Route::get('ventas/create/{cliente_id}', [SaleController::class,'create'])->middleware('can:admin.home')->name('admin.sales.create');
Route::get('ventas/index2', [SaleController::class,'index2'])->middleware('can:admin.home')->name('admin.sales.index2');
Route::resource('ventas', SaleController::class)->middleware('can:admin.home')->names('admin.sales');
Route::resource('comunas', ComunaController::class)->middleware('can:admin.home')->names('admin.comunas');

Route::get('users/index',[UserController::class,'newIndex'])->middleware('can:admin.home')->name('admin.users.newIndex');
Route::get('visits',[VisitController::class,'index'])->middleware('can:admin.home')->name('admin.visits.index');
Route::resource('users',  UserController::class)->only('index','edit','update')->middleware('can:admin.home')->names('admin.users');
Route::resource('roles',  RoleController::class)->middleware('can:admin.home')->names('admin.roles');
Route::get('permission',[RoleController::class,'permission'])->middleware('can:admin.home')->name('admin.permission');
Route::get('pagos-pendientes',[SaleController::class,'pagosPendientes'])->middleware('can:admin.home')->name('admin.sales.pagos_pendientes');

Route::resource('routes', RouteController::class)->middleware('can:admin.home')->names('routes');
Route::get('sectors',[RouteController::class,'sectors'])->middleware('can:admin.home')->name('routes.sectors');
Route::get('report', [ReportController::class,'index'])->middleware('can:admin.home')->name('admin.report');













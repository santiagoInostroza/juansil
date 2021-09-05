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

Route::resource('categorias', CategoryController::class)->names('admin.categories');
Route::resource('etiquetas', TagController::class)->names('admin.tags');
Route::resource('marcas', BrandController::class)->names('admin.brands');


Route::get('productos/newProduct/{producto}',[ProductController::class,'newProduct'])->name('admin.products.new_product');
Route::resource('productos', ProductController::class)->names('admin.products');

Route::resource('proveedores', SupplierController::class)->names('admin.suppliers');
Route::get('compras/create/{proveedor_id}', [PurchaseController::class,'create'])->name('admin.purchases.create');
Route::resource('compras', PurchaseController::class)->names('admin.purchases');

Route::get('deliveries2/{fecha}', [DeliveryController::class,'index2'])->name('admin.deliveries.index2');
Route::get('deliveries/{fecha}', [DeliveryController::class,'index'])->name('admin.deliveries.index');

Route::resource('deliveries', DeliveryController::class)->names('admin.deliveries');

Route::resource('movimientos', MovementController::class)->names('admin.movements');
Route::resource('stock', StockController::class)->names('admin.stock');
Route::get('inventory', [InventarioController::class,'index'])->name('admin.inventory');
Route::get('customer', [CustomerController::class,'lista'])->name('admin.customers.lista');
Route::resource('clientes', CustomerController::class)->names('admin.customers');
Route::get('datos-cliente/{cliente}', [CustomerController::class,'showCustomerData'])->name('admin.customers.datos_cliente');
Route::get('ventas/create/{cliente_id}', [SaleController::class,'create'])->name('admin.sales.create');
Route::resource('ventas', SaleController::class)->names('admin.sales');
Route::resource('comunas', ComunaController::class)->names('admin.comunas');

Route::get('users/index',[UserController::class,'newIndex'])->name('admin.users.newIndex');
Route::resource('users',  UserController::class)->only('index','edit','update')->names('admin.users');
Route::resource('roles',  RoleController::class)->names('admin.roles');
Route::get('permission',[RoleController::class,'permission'])->name('admin.permission');
Route::get('pagos-pendientes',[SaleController::class,'pagosPendientes'])->name('admin.sales.pagos_pendientes');

Route::resource('routes', RouteController::class)->names('routes');
Route::get('sectors',[RouteController::class,'sectors'])->name('routes.sectors');
Route::get('report', [ReportController::class,'index'])->name('admin.report');










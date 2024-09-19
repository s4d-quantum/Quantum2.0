<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SerialPurchaseController;
use App\Http\Controllers\SerialOrderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\GoodsInController;
use App\Http\Controllers\QCController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\GoodsOutController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TrayController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Purchases
Route::resource('purchases', PurchaseController::class);

// Serial Purchases
Route::resource('serial-purchases', SerialPurchaseController::class);

// Orders
Route::resource('orders', OrderController::class);

// Serial Orders
Route::resource('serial-orders', SerialOrderController::class);

// Customers
Route::resource('customers', CustomerController::class);

// Suppliers
Route::resource('suppliers', SupplierController::class);

// Inventory
// Updated the route to point to the 'inventory' method instead of 'index'
Route::get('/inventory', [InventoryController::class, 'inventory'])->name('inventory');

// Goods In
Route::get('/goods-in', [GoodsInController::class, 'index'])->name('goods-in');

// QC
Route::get('/qc', [QCController::class, 'index'])->name('qc');

// Repair
Route::get('/repair', [RepairController::class, 'index'])->name('repair');

// Goods Out
Route::get('/goods-out', [GoodsOutController::class, 'index'])->name('goods-out');

// Sales Orders
Route::get('/sales-orders', [SalesOrderController::class, 'index'])->name('sales-orders');

// Inventory AJAX Routes
Route::get('/inventory/data', [InventoryController::class, 'getData'])->name('inventory.data');
Route::get('/inventory/search-imei', [InventoryController::class, 'searchByImei'])->name('inventory.searchImei');
Route::get('/inventory/search-model', [InventoryController::class, 'searchByModel'])->name('inventory.searchModel');
Route::get('/inventory/get-imei-units-not-confirmed', [InventoryController::class, 'getImeiUnitsNotConfirmed'])->name('inventory.getImeiUnitsNotConfirmed');
Route::get('/inventory/get-serial-units-not-confirmed', [InventoryController::class, 'getSerialUnitsNotConfirmed'])->name('inventory.getSerialUnitsNotConfirmed');
Route::get('/inventory/get-imei-returns', [InventoryController::class, 'getImeiReturns'])->name('inventory.getImeiReturns');
Route::get('/inventory/get-serial-returns', [InventoryController::class, 'getSerialReturns'])->name('inventory.getSerialReturns');
Route::get('/inventory/get-all-returns', [InventoryController::class, 'getAllReturns'])->name('inventory.getAllReturns');
// Add other routes as needed

// Tray Update

Route::get('/item/{item_code}', [ItemController::class, 'showItemDetails'])->name('item.details');
Route::post('/tray/update', [TrayController::class, 'update'])->name('tray.update');

// item details
Route::get('/inventory/item/{item_code}', [InventoryController::class, 'showItemDetails'])->name('inventory.item.details');

// itemController
Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);


// Authentication routes (if you're using Laravel's built-in authentication)
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

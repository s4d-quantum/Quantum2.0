<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/* Route::middleware('api')->group(function () { */
    Route::get('/inventory', [InventoryController::class, 'index']);
    Route::get('/inventory/count', [InventoryController::class, 'getTotalCount']);
    Route::get('/inventory/export', [InventoryController::class, 'export']);
    Route::get('/inventory', [InventoryController::class, 'index']);
    Route::get('/inventory/purchase', [InventoryController::class, 'searchByPurchaseId']);
    Route::get('/imei-stock-total', [InventoryController::class, 'getImeiStockTotal']);
    Route::get('/serial-stock-total', [InventoryController::class, 'getSerialStockTotal']);
    Route::get('/all-stock-totals', [InventoryController::class, 'getAllStockTotals']);
    Route::get('/daily-booking-stats', [InventoryController::class, 'getDailyBookingStats']);
    Route::get('/search-by-model', [InventoryController::class, 'searchByModel']);
    Route::get('/get-categories', [InventoryController::class, 'getCategories']);
    Route::get('/get-models', [InventoryController::class, 'getModels']);
    Route::get('/get-brands', [InventoryController::class, 'getBrands']);
    Route::get('/get-colors', [InventoryController::class, 'getColors']);
    Route::get('/get-capacities', [InventoryController::class, 'getCapacities']);
    Route::get('/get-storages', [InventoryController::class, 'getStorages']);
    Route::get('/get-networks', [InventoryController::class, 'getNetworks']);
    Route::get('/get-os', [InventoryController::class, 'getOs']);
    Route::get('/get-conditions', [InventoryController::class, 'getConditions']);
    Route::get('/get-prices', [InventoryController::class, 'getPrices']);
    Route::get('/get-stock-status', [InventoryController::class, 'getStockStatus']);
    Route::get('/get-imei-status', [InventoryController::class, 'getImeiStatus']);
    Route::get('/get-serial-status', [InventoryController::class, 'getSerialStatus']);
    Route::get('/get-imei-stock-total', [InventoryController::class, 'getImeiStockTotal']);
    Route::get('/get-serial-stock-total', [InventoryController::class, 'getSerialStockTotal']);
    Route::get('/get-all-stock-totals', [InventoryController::class, 'getAllStockTotals']);
    Route::get('/get-daily-booking-stats', [InventoryController::class, 'getDailyBookingStats']);
    Route::get('/get-monthly-booking-stats', [InventoryController::class, 'getMonthlyBookingStats']);
    Route::get('/get-yearly-booking-stats', [InventoryController::class, 'getYearlyBookingStats']);
    Route::get('/get-stock-status-by-date', [InventoryController::class, 'getStockStatusByDate']);
    Route::get('/get-stock-status-by-imei', [InventoryController::class, 'getStockStatusByImei']);
    Route::get('/get-stock-status-by-serial', [InventoryController::class, 'getStockStatusBySerial']);
    Route::get('/get-stock-status-by-model', [InventoryController::class, 'getStockStatusByModel']);
    Route::get('/get-stock-status-by-brand', [InventoryController::class, 'getStockStatusByBrand']);
    Route::get('/get-stock-status-by-color', [InventoryController::class, 'getStockStatusByColor']);
    Route::get('/get-stock-status-by-capacity', [InventoryController::class, 'getStockStatusByCapacity']);
    Route::get('/get-stock-status-by-storage', [InventoryController::class, 'getStockStatusByStorage']);
    Route::get('/get-stock-status-by-network', [InventoryController::class, 'getStockStatusByNetwork']);
    Route::get('/get-stock-status-by-os', [InventoryController::class, 'getStockStatusByOs']);
    Route::get('/get-stock-status-by-condition', [InventoryController::class, 'getStockStatusByCondition']);
    Route::get('/get-stock-status-by-price', [InventoryController::class, 'getStockStatusByPrice']);
    Route::get('/get-stock-status-by-stock-status', [InventoryController::class, 'getStockStatusByStockStatus']);
    Route::get('/get-stock-status-by-imei-status', [InventoryController::class, 'getStockStatusByImeiStatus']);
    Route::get('/get-stock-status-by-serial-status', [InventoryController::class, 'getStockStatusBySerialStatus']);
    Route::get('/imei-units-not-confirmed', [InventoryController::class, 'getImeiUnitsNotConfirmed']);
    Route::get('/serial-units-not-confirmed', [InventoryController::class, 'getSerialUnitsNotConfirmed']);
    Route::get('/imei-returns', [InventoryController::class, 'getImeiReturns']);
    Route::get('/serial-returns', [InventoryController::class, 'getSerialReturns']);
    Route::get('/all-returns', [InventoryController::class, 'getAllReturns']);
    Route::get('/serial-goods-in', [InventoryController::class, 'getSerialGoodsIn']);
    Route::get('/imei-goods-in', [InventoryController::class, 'getImeiGoodsIn']);
    Route::get('/categories', [InventoryController::class, 'getCategories']);
    Route::get('/search-by-model', [InventoryController::class, 'searchByModel']);


    Route::middleware('api')->get('/inventory', [InventoryController::class, 'index']);

    Route::get('/test-cors', function () {
        return response()->json(['message' => 'CORS is working!']);
    });


/* }); */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

namespace App\Http\Controllers;

use App\Models\Imei;
use App\Models\SerialProduct;
use App\Models\Tac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventoryController extends Controller
{
    // Method to render the inventory view
    public function inventory()
    {
        // Fetch data needed for the filters
        $categories = DB::table('tbl_categories')->get(); // Table exists
        $grades = DB::table('tbl_grades')->get();
        $suppliers = DB::table('tbl_suppliers')->get();
        $customers = DB::table('tbl_customers')->get();
        $colors = $this->getColors();
        $trays = $this->getTrays();

        return view('inventory.index', compact('categories', 'grades', 'suppliers', 'customers', 'colors', 'trays'));
    }

    private function getColors()
    {
        // Fetch distinct colors from the tbl_imei table
        return DB::table('tbl_imei')->distinct()->pluck('item_color');
    }

    private function getTrays()
    {
        // Fetch trays from the tbl_trays table
        return DB::table('tbl_trays')->get();
    }

    public function index(Request $request)
    {
        if (!$request->has('imei')) {
            return response()->json(['error' => 'IMEI is required'], 400);
        }

        $imei = $request->input('imei');

        $item = Imei::with(['tac', 'purchase'])
            ->where('item_imei', $imei)
            ->first();

        if (!$item) {
            return response()->json(['error' => 'IMEI not found'], 404);
        }

        return response()->json($item);
    }

    public function searchByPurchaseId(Request $request)
    {
        $purchaseId = $request->input('purchase_id');

        if (!$purchaseId) {
            return response()->json(['error' => 'Purchase ID is required'], 400);
        }

        $items = Imei::with(['tac', 'purchase'])
            ->where('purchase_id', $purchaseId)
            ->get();

        if ($items->isEmpty()) {
            return response()->json(['error' => 'No items found for this Purchase ID'], 404);
        }

        return response()->json($items);
    }

    public function getImeiStockTotal()
    {
        $totalItems = DB::table('tbl_imei')
            ->where('status', 1) // Status 1 indicates 'in stock'
            ->count();

        return response()->json([
            'total_items' => $totalItems
        ]);
    }

    public function getSerialStockTotal()
    {
        $totalItems = DB::table('tbl_serial_products')
            ->where('status', 1)
            ->count();

        return response()->json([
            'total_items' => $totalItems
        ]);
    }

    public function getAllStockTotals()
    {
        $imeiTotal = DB::table('tbl_imei')
            ->where('status', 1)
            ->count();

        $serialTotal = DB::table('tbl_serial_products')
            ->where('status', 1)
            ->count();

        return response()->json([
            'imei_total' => $imeiTotal,
            'serial_total' => $serialTotal
        ]);
    }

    public function getDailyBookingStats()
    {
        $today = Carbon::today()->toDateString();

        $imeiBookingIn = DB::table('tbl_purchases')
            ->whereDate('date', $today)
            ->count('item_imei');

        $imeiBookingOut = DB::table('tbl_orders')
            ->whereDate('date', $today)
            ->count('item_imei');

        $serialBookingIn = DB::table('tbl_serial_purchases')
            ->whereDate('date', $today)
            ->count('item_code');

        $serialBookingOut = DB::table('tbl_serial_orders')
            ->whereDate('date', $today)
            ->count('item_code');

        return response()->json([
            'imei_booking_in' => $imeiBookingIn,
            'imei_booking_out' => $imeiBookingOut,
            'serial_booking_in' => $serialBookingIn,
            'serial_booking_out' => $serialBookingOut
        ]);
    }

    public function getImeiUnitsNotConfirmed()
    {
        $unconfirmedCount = DB::table('tbl_orders')
            ->where('unit_confirmed', 0)
            ->distinct('order_id')
            ->count('order_id');

        return response()->json([
            'imei_units_not_confirmed' => $unconfirmedCount
        ]);
    }

    public function getSerialUnitsNotConfirmed()
    {
        $unconfirmedCount = DB::table('tbl_serial_orders')
            ->where('unit_confirmed', 0)
            ->distinct('order_id')
            ->count('order_id');

        return response()->json([
            'serial_units_not_confirmed' => $unconfirmedCount
        ]);
    }

    public function getImeiReturns()
    {
        $imeiReturns = DB::table('tbl_purchases')
            ->where('purchase_return', 1)
            ->count();

        return response()->json([
            'imei_returns' => $imeiReturns
        ]);
    }

    public function getSerialReturns()
    {
        $serialReturns = DB::table('tbl_serial_purchases')
            ->where('purchase_return', 1)
            ->count();

        return response()->json([
            'serial_returns' => $serialReturns
        ]);
    }

    public function getAllReturns()
    {
        $imeiReturns = DB::table('tbl_purchases')
            ->where('purchase_return', 1)
            ->count();

        $serialReturns = DB::table('tbl_serial_purchases')
            ->where('purchase_return', 1)
            ->count();

        return response()->json([
            'imei_returns' => $imeiReturns,
            'serial_returns' => $serialReturns,
            'total_returns' => $imeiReturns + $serialReturns
        ]);
    }

    public function getSerialGoodsIn(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $serialGoodsIn = DB::table('tbl_serial_purchases')
            ->orderBy('date', 'desc')
            ->paginate($perPage);

        return response()->json($serialGoodsIn);
    }

    public function getImeiGoodsIn(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $imeiGoodsIn = DB::table('tbl_purchases')
            ->orderBy('date', 'desc')
            ->paginate($perPage);

        return response()->json($imeiGoodsIn);
    }

    public function getCategories()
    {
        $categories = DB::table('tbl_tac')
            ->select('item_brand')
            ->distinct()
            ->orderBy('item_brand')
            ->get()
            ->pluck('item_brand');

        return response()->json($categories);
    }

    // Renamed one of the methods to avoid duplication
    public function searchTacByModel(Request $request)
    {
        $searchTerm = $request->input('searchMODEL');
        $perPage = $request->input('per_page', 15);

        $results = Tac::where('item_details', 'LIKE', "%{$searchTerm}%")
            ->orWhere('item_brand', 'LIKE', "%{$searchTerm}%")
            ->paginate($perPage);

        return response()->json($results);
    }

    public function searchByModel(Request $request)
    {
        $model = $request->input('model');

        $results = \DB::table('tbl_imei')
            ->leftJoin('tbl_tac', 'tbl_imei.item_tac', '=', 'tbl_tac.item_tac')
            ->where('tbl_tac.item_details', 'like', "%{$model}%")
            ->get();

        return response()->json($results);
    }

    public function getData(Request $request)
    {
        try {
            // Start building the query
            $query = \DB::table('tbl_imei')
                ->leftJoin('tbl_tac', 'tbl_imei.item_tac', '=', 'tbl_tac.item_tac')
                ->leftJoin('tbl_purchases', function($join) {
                    $join->on('tbl_imei.item_imei', '=', 'tbl_purchases.item_imei')
                        ->on('tbl_imei.purchase_id', '=', 'tbl_purchases.purchase_id');
                })
                ->leftJoin('tbl_orders', 'tbl_imei.item_imei', '=', 'tbl_orders.item_imei')
                ->leftJoin('tbl_suppliers', 'tbl_purchases.supplier_id', '=', 'tbl_suppliers.supplier_id')
                ->leftJoin('tbl_grades', 'tbl_imei.item_grade', '=', 'tbl_grades.grade_id');

            // Apply filters based on request parameters
            if ($request->stockType) {
                if ($request->stockType == 'instock') {
                    $query->where('tbl_imei.status', 1);
                } elseif ($request->stockType == 'sold') {
                    $query->where('tbl_imei.status', 0);
                }
                // 'all' requires no additional filter
            }

            if ($request->category) {
                $query->where('tbl_tac.item_brand', $request->category);
            }

            if ($request->color) {
                $query->where('tbl_imei.item_color', $request->color);
            }

            if ($request->gb) {
                $query->where('tbl_imei.item_gb', $request->gb);
            }

            if ($request->grade) {
                $query->where('tbl_imei.item_grade', $request->grade);
            }

            if ($request->tray) {
                $query->where('tbl_purchases.tray_id', $request->tray);
            }

            if (!is_null($request->qcDone) && $request->qcDone !== '') {
                $query->where('tbl_purchases.qc_completed', $request->qcDone);
            }

            if (!is_null($request->qcStatus) && $request->qcStatus !== '') {
                $query->where('tbl_purchases.qc_required', $request->qcStatus);
            }

            if ($request->supplier) {
                $query->where('tbl_purchases.supplier_id', $request->supplier);
            }

            if ($request->customer) {
                $query->where('tbl_orders.customer_id', $request->customer);
            }

            if ($request->fromDate && $request->toDate) {
                $query->whereBetween('tbl_purchases.date', [$request->fromDate, $request->toDate]);
            }

            // Fetch the data
            $inventoryData = $query->select(
                'tbl_imei.*',
                'tbl_tac.item_brand',
                'tbl_tac.item_details',
                'tbl_purchases.tray_id',
                'tbl_purchases.date as purchase_date',
                'tbl_purchases.supplier_id',
                'tbl_suppliers.name as supplier_name',
                'tbl_orders.customer_id',
                'tbl_orders.date as order_date',
                'tbl_grades.title as grade_title'
            )->get();

            // Return the data as JSON
            return response()->json($inventoryData);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching inventory data: ' . $e->getMessage());
            // Return error as JSON
            return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function searchByImei(Request $request)
    {
        $imei = $request->input('imei');

        $results = \DB::table('tbl_imei')
            ->where('item_imei', 'like', "%{$imei}%")
            ->get();

        return response()->json($results);
    }
    public function showItemDetails($item_code)
    {
    // Fetch item details from the primary database
    $item = DB::table('tbl_imei')
        ->leftJoin('tbl_tac', 'tbl_imei.item_tac', '=', 'tbl_tac.item_tac')
        ->leftJoin('tbl_purchases', 'tbl_imei.purchase_id', '=', 'tbl_purchases.purchase_id')
        ->where('tbl_imei.item_imei', $item_code)
        ->select('tbl_imei.*', 'tbl_tac.*', 'tbl_purchases.*')
        ->first();

    if (!$item) {
        abort(404, 'Item not found');
    }

    // Fetch logs from the primary database
    $logs = DB::table('tbl_log')
        ->where('item_code', $item_code)
        ->orderBy('id', 'DESC')
        ->get();

    // Fetch user details from the secondary database
    $userIds = $logs->pluck('user_id')->unique();

    // Fetch users from the secondary database connection
    $users = DB::connection('mysql_users')->table('tbl_accounts')
        ->whereIn('user_id', $userIds)
        ->get()
        ->keyBy('user_id');

    // Fetch trays for the dropdown
    $trays = DB::table('tbl_trays')->get();

    // Pass data to the view
    return view('inventory.item_details', compact('item', 'logs', 'users', 'trays'));
    }

}

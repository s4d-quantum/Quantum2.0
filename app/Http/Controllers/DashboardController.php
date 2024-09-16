<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
        $user = Auth::user();

        // Fetch company info
//        $company_info = DB::table('tbl_settings')->select('company_title')->first();

        // Fetch IMEI stock count
        $imei_products_total = DB::table('tbl_imei')->where('status', 1)->count();

        // Fetch Serial stock count
        $serial_products_total = DB::table('tbl_serial_products')->where('status', 1)->count();

        // Today's bookings
        $total_bookingin = DB::table('tbl_purchases')->whereDate('date', $date)->count();
        $total_bookingout = DB::table('tbl_orders')->whereDate('date', $date)->count();

        // Serial bookings
        $total_serial_bookingin = DB::table('tbl_serial_purchases')->whereDate('date', $date)->count();
        $total_serial_bookingout = DB::table('tbl_serial_orders')->whereDate('date', $date)->count();

        // Units not confirmed
        $unit_confirmed = DB::table('tbl_orders')->where('unit_confirmed', 0)->distinct('order_id')->count('order_id');
        $serial_unit_confirmed = DB::table('tbl_serial_orders')->where('unit_confirmed', 0)->distinct('order_id')->count('order_id');

        // Returns
        $total_imei_returns = DB::table('tbl_purchases')
            ->join('tbl_imei', 'tbl_imei.item_imei', '=', 'tbl_purchases.item_imei')
            ->where('tray_id', 'Returns')
            ->where('tbl_imei.status', 1)
            ->distinct('tbl_imei.item_imei')
            ->count('tbl_imei.item_imei');

        $total_serial_returns = DB::table('tbl_serial_purchases as pr')
            ->join('tbl_serial_products as pro', 'pro.item_code', '=', 'pr.item_code')
            ->where('pr.tray_id', 'Returns')
            ->where('pro.status', 1)
            ->distinct('pro.item_code')
            ->count('pro.item_code');

        // Fetch recent IMEI goods in (latest 10 entries)
        $recent_imei_goods_in = DB::table('tbl_purchases')
            ->join('tbl_imei', 'tbl_imei.item_imei', '=', 'tbl_purchases.item_imei')
            ->select('tbl_imei.item_imei', 'tbl_purchases.date')
            ->orderBy('tbl_purchases.date', 'desc')
            ->paginate(10);

        // Fetch recent Serial goods in (latest 10 entries)
        $recent_serial_goods_in = DB::table('tbl_serial_purchases as pr')
            ->join('tbl_serial_products as pro', 'pro.item_code', '=', 'pr.item_code')
            ->select('pro.item_code', 'pr.date')
            ->orderBy('pr.date', 'desc')
            ->paginate(10);

        return view('dashboard.index', compact(
            'imei_products_total',
            'serial_products_total',
            'total_bookingin',
            'total_bookingout',
            'total_serial_bookingin',
            'total_serial_bookingout',
            'unit_confirmed',
            'serial_unit_confirmed',
            'total_imei_returns',
            'total_serial_returns',
            'recent_imei_goods_in',
            'recent_serial_goods_in',
            'user'
        ));
    }
}

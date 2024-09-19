<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrayController extends Controller
{
    public function update(Request $request)
    {
        $item_code = $request->input('item_code');
        $purchase_id = $request->input('purchase_id');
        $tray_id = $request->input('tray_id');
        $user_id = $request->input('user_id');

        // Update the tray in the database
        DB::table('tbl_purchases')
            ->where('item_imei', $item_code)
            ->where('purchase_id', $purchase_id)
            ->update(['tray_id' => $tray_id]);

        // Log the change if necessary

        return response()->json(['success' => true]);
    }
}

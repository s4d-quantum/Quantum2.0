<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QCController extends Controller
{
    public function pendingQC()
    {
        $imeiPendingQC = $this->imeiPendingQC();
        $serialPendingQC = $this->serialPendingQC();
        $imeiUnitsNotConfirmed = $this->imeiUnitsNotConfirmed();
        $serialUnitsNotConfirmed = $this->serialUnitsNotConfirmed();

        return view('pending-qc', compact('imeiPendingQC', 'serialPendingQC', 'imeiUnitsNotConfirmed', 'serialUnitsNotConfirmed'));
    }

    public function imeiPendingQC()
    {
        $imeiPendingQC = DB::table('tbl_purchases')
            ->where('qc_required', 1)
            ->where('qc_completed', 0)
            ->count();

        return $imeiPendingQC;
    }

    public function serialPendingQC()
    {
        $serialPendingQC = DB::table('tbl_serial_purchases')
            ->where('qc_required', 1)
            ->where('qc_completed', 0)
            ->count();

        return $serialPendingQC;
    }

    public function imeiUnitsNotConfirmed()
    {
        $imeiUnitsNotConfirmed = DB::table('tbl_orders')
            ->where('unit_confirmed', 0)
            ->distinct('order_id')
            ->count('order_id');

        return $imeiUnitsNotConfirmed;
    }

    public function serialUnitsNotConfirmed()
    {
        $serialUnitsNotConfirmed = DB::table('tbl_serial_orders')
            ->where('unit_confirmed', 0)
            ->distinct('order_id')
            ->count('order_id');

        return $serialUnitsNotConfirmed;
    }
}

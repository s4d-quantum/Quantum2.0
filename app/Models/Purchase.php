<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'tbl_purchases';
    protected $primaryKey = 'id';

    protected $fillable = [
        'purchase_id',
        'item_imei',
        'date',
        'supplier_id',
        'tray_id',
        'qc_required',
        'qc_completed',
        'repair_required',
        'repair_completed',
        'purchase_return',
        'priority',
        'user_id',
        'report_comment',
        'po_ref',
        'has_return_tag',
        'unit_confirmed',
    ];

    public $timestamps = false;

    public function imei()
    {
        return $this->hasOne(Imei::class, 'purchase_id', 'purchase_id');
    }

    public function qcImeiProduct()
    {
        return $this->hasOne(QcImeiProduct::class, 'purchase_id', 'purchase_id');
    }


    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function imeiProduct()
    {
        return $this->hasOne(IMEIProduct::class, 'purchase_id', 'purchase_id');
    }
}

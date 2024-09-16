<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerialPurchase extends Model
{
    protected $table = 'tbl_serial_purchases';
    protected $primaryKey = 'id';

    protected $fillable = [
        'purchase_id',
        'item_code',
        'date',
        'supplier_id',
        'tray_id',
        'qc_required',
        'qc_completed',
        'purchase_return',
        'user_id',
        'report_comment',
        'priority',
        'po_ref',
        'has_return_tag',
        'unit_confirmed',
    ];

    public $timestamps = false;

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function serialProduct()
    {
        return $this->hasOne(SerialProduct::class, 'purchase_id', 'purchase_id');
    }
}

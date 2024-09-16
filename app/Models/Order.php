<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tbl_orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'item_imei',
        'customer_id',
        'date',
        'po_box',
        'tracking_no',
        'customer_ref',
        'delivery_company',
        'total_boxes',
        'total_pallets',
        'order_return',
        'user_id',
        'unit_confirmed',
        'has_return_tag',
        'is_delivered',
    ];

    public $timestamps = false;

    public function imei()
    {
        return $this->belongsTo(Imei::class, 'item_imei', 'item_imei');
    }

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function imeiProduct()
    {
        return $this->belongsTo(IMEIProduct::class, 'item_imei', 'item_imei');
    }

    public function imei()
    {
        return $this->belongsTo(Imei::class, 'item_imei', 'item_imei');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerialOrder extends Model
{
    protected $table = 'tbl_serial_orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'item_code',
        'customer_id',
        'date',
        'po_box',
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

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function serialProduct()
    {
        return $this->belongsTo(SerialProduct::class, 'item_code', 'item_code');
    }
}

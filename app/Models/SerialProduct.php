<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerialProduct extends Model
{
    protected $table = 'tbl_serial_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'purchase_id',
        'item_code',
        'item_grade',
        'item_brand',
        'item_details',
        'status',
    ];

    public $timestamps = false;

    // Relationships
    public function purchase()
    {
        return $this->belongsTo(SerialPurchase::class, 'purchase_id', 'purchase_id');
    }

    public function orders()
    {
        return $this->hasMany(SerialOrder::class, 'item_code', 'item_code');
    }
}

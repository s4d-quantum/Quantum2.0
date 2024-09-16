<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IMEIProduct extends Model
{
    protected $table = 'tbl_imei';
    protected $primaryKey = 'id';

    protected $fillable = [
        'item_imei',
        'item_tac',
        'item_color',
        'item_grade',
        'item_gb',
        'purchase_id',
        'status',
        'unit_confirmed',
        'created_at',
    ];

    public $timestamps = false;

    // Relationships
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'purchase_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'item_imei', 'item_imei');
    }
}

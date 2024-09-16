<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcImeiProduct extends Model
{
    protected $table = 'tbl_qc_imei_products';
    
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'purchase_id', 'item_code', 'item_comments', 'item_cosmetic_passed',
        'item_functional_passed', 'item_flashed', 'user_id', 'item_eu'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'purchase_id');
    }

    public function imei()
    {
        return $this->belongsTo(Imei::class, 'item_code', 'item_imei');
    }
}

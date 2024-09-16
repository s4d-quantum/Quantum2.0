<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imei extends Model
{
    protected $table = 'tbl_imei';
    
    protected $fillable = [
        'item_imei', 'item_tac', 'item_color', 'item_grade', 'item_gb',
        'purchase_id', 'status', 'unit_confirmed'
    ];

    public function tac()
    {
        return $this->belongsTo(Tac::class, 'item_tac', 'item_tac');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'purchase_id');
    }


}

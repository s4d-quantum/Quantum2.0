<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tac extends Model
{
    protected $table = 'tbl_tac';
    
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'item_tac', 'item_details', 'item_brand', 'item_gb1', 'item_color1'
    ];

    public function imeis()
    {
        return $this->hasMany(Imei::class, 'item_tac', 'item_tac');
    }
}

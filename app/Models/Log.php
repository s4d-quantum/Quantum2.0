<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'tbl_log';
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'item_code',
        'subject',
        'details',
        'ref',
        'auto_time',
        'user_id',
    ];

    public $timestamps = false;

    // Relationships (if any)
}

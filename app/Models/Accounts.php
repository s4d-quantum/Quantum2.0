<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'tbl_accounts';

    // Specify the connection name
    protected $connection = 'mysql_users';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'user_id';

    // Disable timestamps if not used
    public $timestamps = false;

    // Fillable fields
    protected $fillable = [
        'user_id',
        'user_name',
        'user_db',
        'user_email',
        'user_password',
        'user_role',
        'user_phone',
    ];
}

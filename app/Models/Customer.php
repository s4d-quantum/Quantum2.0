<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'tbl_customers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'name',
        'address',
        'phone',
        'email',
        'city',
        'country',
        'user_id',
        'address2',
        'postcode',
        'vat',
    ];

    public $timestamps = false;

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'tbl_suppliers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'supplier_id',
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
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'supplier_id', 'supplier_id');
    }
}

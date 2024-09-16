<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'tbl_settings';

    protected $fillable = [
        'dpd_user',
        'dpd_pass',
        'email',
        'company_title',
        'logo_image',
        'postcode',
        'phone',
        'vat',
        'eroi_no',
        'company_registration_no',
        'address',
        'city',
        'country',
    ];

    public $timestamps = false;
}

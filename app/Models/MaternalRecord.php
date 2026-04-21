<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaternalRecord extends Model
{
    protected $fillable = [
        'full_name',
        'age',
        'address',
        'contact_number',
        'pregnancy_stage',
        'last_checkup_date',
        'expected_delivery_date',
        'risk_level',
    ];

    protected $casts = [
        'last_checkup_date' => 'date',
        'expected_delivery_date' => 'date',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
     protected $fillable = [
        'name',
        'category',
        'barangay',
        'contact_number',
    ];
}

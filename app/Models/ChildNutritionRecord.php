<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildNutritionRecord extends Model
{
    protected $fillable = [
        'full_name',
        'age_months',
        'barangay',
        'weight_kg',
        'height_cm',
        'nutritional_status',
        'last_weigh_in_date',
    ];

    protected $casts = [
        'last_weigh_in_date' => 'date',
    ];
}

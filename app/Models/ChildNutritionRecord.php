<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ChildNutritionRecordObserver;

/**
 * @property int $id
 * @property string $full_name
 * @property int $age_months
 * @property string $barangay
 * @property float $weight_kg
 * @property float $height_cm
 * @property string $nutritional_status
 * @property \Carbon\Carbon $last_weigh_in_date
 */
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
        'age_months' => 'integer',
        'weight_kg' => 'float',
        'height_cm' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(ChildNutritionRecordObserver::class);
    }
}

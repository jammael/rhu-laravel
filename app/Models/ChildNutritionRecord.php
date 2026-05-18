<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\ChildNutritionRecordObserver;

/**
 * @property int $id
 * @property int $patient_id
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
    use SoftDeletes;

    protected $appends = [
        'display_name',
        'display_barangay',
    ];

    protected $fillable = [
        'patient_id',
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

    /**
     * Get the patient associated with this nutrition record.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->patient?->name ?? $this->full_name;
    }

    public function getDisplayBarangayAttribute(): string
    {
        return $this->patient?->barangay ?? $this->barangay;
    }
}

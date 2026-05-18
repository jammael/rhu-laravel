<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\MaternalRecordObserver;

class MaternalRecord extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
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

    protected $dates = ['deleted_at'];

    protected $appends = [
        'display_name',
        'display_address',
        'display_contact_number',
    ];

    /**
     * Get the patient associated with this maternal record.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->patient?->name ?? $this->full_name;
    }

    public function getDisplayAddressAttribute(): string
    {
        return $this->patient?->barangay ?? $this->address;
    }

    public function getDisplayContactNumberAttribute(): string
    {
        return $this->patient?->contact_number ?? $this->contact_number;
    }

    /**
     * Register observers for this model
     */
    protected static function boot()
    {
        parent::boot();
        static::observe(MaternalRecordObserver::class);
    }
}

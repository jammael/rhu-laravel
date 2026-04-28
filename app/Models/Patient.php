<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
     protected $fillable = [
        'name',
        'birthdate',
        'category',
        'barangay',
        'contact_number',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    /**
     * Get the child nutrition records associated with this patient.
     */
    public function childNutritionRecords()
    {
        return $this->hasMany(ChildNutritionRecord::class);
    }

    /**
     * Get the maternal records associated with this patient.
     */
    public function maternalRecords()
    {
        return $this->hasMany(MaternalRecord::class);
    }
}

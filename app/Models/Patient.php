<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public static function findExisting(string $name, ?string $barangay = null, ?string $category = null): ?self
    {
        return self::query()
            ->whereRaw('LOWER(name) = ?', [strtolower(trim($name))])
            ->when($barangay, fn (Builder $query) => $query->whereRaw('LOWER(barangay) = ?', [strtolower(trim($barangay))]))
            ->when($category, fn (Builder $query) => $query->where('category', $category))
            ->first();
    }

    public static function findOrCreateForModule(array $attributes): self
    {
        $patient = self::findExisting(
            $attributes['name'],
            $attributes['barangay'] ?? null,
            $attributes['category'] ?? null
        );

        if ($patient) {
            $updates = array_filter([
                'name' => $attributes['name'],
                'birthdate' => $attributes['birthdate'] ?? $patient->birthdate,
                'category' => $attributes['category'] ?? $patient->category,
                'barangay' => $attributes['barangay'] ?? $patient->barangay,
                'contact_number' => $attributes['contact_number'] ?? $patient->contact_number,
            ], fn ($value) => $value !== null && $value !== '');

            if (($updates['contact_number'] ?? null) === 'N/A' && $patient->contact_number && $patient->contact_number !== 'N/A') {
                unset($updates['contact_number']);
            }

            $patient->fill($updates);

            $patient->save();

            return $patient;
        }

        return self::create($attributes);
    }

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

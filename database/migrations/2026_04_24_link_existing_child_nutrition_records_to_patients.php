<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Link existing child nutrition records to patients by name and barangay
        $childNutritionRecords = DB::table('child_nutrition_records')
            ->whereNull('patient_id')
            ->get();

        foreach ($childNutritionRecords as $record) {
            // Try to find matching patient
            $patient = DB::table('patients')
                ->where('name', $record->full_name)
                ->where('barangay', $record->barangay)
                ->where('category', 'child')
                ->first();

            // If no matching patient found, create one
            if (!$patient) {
                $birthdate = now()->subMonths($record->age_months);
                $patientId = DB::table('patients')->insertGetId([
                    'name' => $record->full_name,
                    'birthdate' => $birthdate,
                    'category' => 'child',
                    'barangay' => $record->barangay,
                    'contact_number' => 'N/A',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $patientId = $patient->id;
            }

            // Link the nutrition record to the patient
            DB::table('child_nutrition_records')
                ->where('id', $record->id)
                ->update(['patient_id' => $patientId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration creates relationships, so reversing it would orphan records
        // Only reset patient_id for records created during this migration
        // (records that have 'N/A' contact_number in linked patients)
        DB::table('child_nutrition_records')
            ->whereIn('patient_id',
                DB::table('patients')
                    ->where('contact_number', 'N/A')
                    ->pluck('id')
            )
            ->update(['patient_id' => null]);
    }
};

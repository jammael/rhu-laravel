<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            DB::table('maternal_records')
                ->whereNull('patient_id')
                ->orderBy('id')
                ->each(function ($record) {
                    $patient = DB::table('patients')
                        ->whereRaw('LOWER(name) = ?', [strtolower($record->full_name)])
                        ->whereRaw('LOWER(barangay) = ?', [strtolower($record->address)])
                        ->where('category', 'pregnant')
                        ->first();

                    if (! $patient) {
                        $patientId = DB::table('patients')->insertGetId([
                            'name' => $record->full_name,
                            'birthdate' => now()->subYears((int) $record->age)->toDateString(),
                            'category' => 'pregnant',
                            'barangay' => $record->address,
                            'contact_number' => $record->contact_number,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } else {
                        $patientId = $patient->id;
                    }

                    DB::table('maternal_records')
                        ->where('id', $record->id)
                        ->update(['patient_id' => $patientId]);
                });

            DB::table('child_nutrition_records')
                ->whereNull('patient_id')
                ->orderBy('id')
                ->each(function ($record) {
                    $patient = DB::table('patients')
                        ->whereRaw('LOWER(name) = ?', [strtolower($record->full_name)])
                        ->whereRaw('LOWER(barangay) = ?', [strtolower($record->barangay)])
                        ->where('category', 'child')
                        ->first();

                    if (! $patient) {
                        $patientId = DB::table('patients')->insertGetId([
                            'name' => $record->full_name,
                            'birthdate' => now()->subMonths((int) $record->age_months)->toDateString(),
                            'category' => 'child',
                            'barangay' => $record->barangay,
                            'contact_number' => 'N/A',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } else {
                        $patientId = $patient->id;
                    }

                    DB::table('child_nutrition_records')
                        ->where('id', $record->id)
                        ->update(['patient_id' => $patientId]);
                });
        });
    }

    public function down(): void
    {
        // This migration links existing records to the master patients table.
        // It is intentionally not reversed to avoid orphaning medical records.
    }
};

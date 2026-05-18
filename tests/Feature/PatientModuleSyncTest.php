<?php

use App\Models\ChildNutritionRecord;
use App\Models\MaternalRecord;
use App\Models\Patient;
use App\Models\User;

test('maternal care creation registers and links a central patient', function () {
    $staff = User::factory()->create([
        'role' => 'nurse',
        'status' => 'approved',
    ]);

    $this->actingAs($staff)->post(route('maternal.store'), [
        'full_name' => 'Maria Santos',
        'age' => 28,
        'address' => 'Poblacion',
        'contact_number' => '09175551234',
        'pregnancy_stage' => 'second_trimester',
        'last_checkup_date' => now()->subDays(5)->toDateString(),
        'expected_delivery_date' => now()->addMonths(4)->toDateString(),
    ])->assertRedirect(route('maternal.index'));

    $patient = Patient::where('name', 'Maria Santos')->where('category', 'pregnant')->first();
    expect($patient)->not->toBeNull();

    $record = MaternalRecord::with('patient')->first();
    expect($record->patient_id)->toBe($patient->id)
        ->and($record->display_name)->toBe('Maria Santos');
});

test('child nutrition creation registers and links a central patient', function () {
    $staff = User::factory()->create([
        'role' => 'nurse',
        'status' => 'approved',
    ]);

    $this->actingAs($staff)->post(route('child-nutrition.store'), [
        'full_name' => 'Princess Litub',
        'age_months' => 36,
        'barangay' => 'Carmen',
        'weight_kg' => 19,
        'height_cm' => 183,
        'last_weigh_in_date' => now()->toDateString(),
    ])->assertRedirect(route('child-nutrition.index'));

    $patient = Patient::where('name', 'Princess Litub')->where('category', 'child')->first();
    expect($patient)->not->toBeNull();

    $record = ChildNutritionRecord::with('patient')->first();
    expect($record->patient_id)->toBe($patient->id)
        ->and($record->display_name)->toBe('Princess Litub');
});

test('updating patient enrollment updates linked module displays', function () {
    $staff = User::factory()->create([
        'role' => 'nurse',
        'status' => 'approved',
    ]);

    $patient = Patient::create([
        'name' => 'Sir Buds',
        'birthdate' => now()->subYears(3)->toDateString(),
        'category' => 'child',
        'barangay' => 'Old Barangay',
        'contact_number' => 'N/A',
    ]);

    ChildNutritionRecord::create([
        'patient_id' => $patient->id,
        'full_name' => 'Sir Buds',
        'age_months' => 36,
        'barangay' => 'Old Barangay',
        'weight_kg' => 18,
        'height_cm' => 100,
        'last_weigh_in_date' => now()->toDateString(),
    ]);

    $this->actingAs($staff)->put(route('patients.update', $patient), [
        'name' => 'Sir Budz',
        'birthdate' => $patient->birthdate->format('Y-m-d'),
        'category' => 'child',
        'barangay' => 'New Barangay',
        'contact_number' => '09123456789',
    ])->assertRedirect(route('patients.show', $patient));

    $record = ChildNutritionRecord::with('patient')->first();
    expect($record->display_name)->toBe('Sir Budz')
        ->and($record->display_barangay)->toBe('New Barangay');
});

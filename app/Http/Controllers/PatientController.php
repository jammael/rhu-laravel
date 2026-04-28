<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\ChildNutritionRecord;
use App\Models\MaternalRecord;
class PatientController extends Controller
{
    /**
     * Show the selection page for choosing between Maternal or Child enrollment.
     */
    public function select()
    {
        return view('patients.select');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Patient::query();

        // Search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter (pregnant or child)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Dashboard filter
        if ($request->filled('filter')) {
            $query = match ($request->filter) {
                'pregnant' => $query->where('category', 'pregnant'),
                'child' => $query->where('category', 'child'),
                'all' => $query, // All patients
                default => $query,
            };
        }

        $patients = $query->get();

        return view('patients.index', compact('patients'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate that the type parameter is valid
        $type = $request->query('type', 'maternal');
        if (!in_array($type, ['maternal', 'child'])) {
            $type = 'maternal';
        }

        return view('patients.create', ['type' => $type]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Get the type from POST data or query string
        $type = $request->input('type') ?? $request->query('type', 'maternal');

        // Base validation that applies to all types
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'birthdate'      => 'required|date',
            'category'       => 'required|in:pregnant,child',
            'barangay'       => 'required|string',
            'contact_number' => 'required|string',
        ]);

        // Additional validation for child nutrition records
        $childValidated = null;
        if ($type === 'child') {
            $childValidated = $request->validate([
                'age_months'         => 'required|integer|min:0|max:180',
                'weight_kg'          => 'required|numeric|min:0.1|max:100',
                'height_cm'          => 'required|numeric|min:0.1|max:250',
                'last_weigh_in_date' => 'required|date',
            ]);
        }

        // Additional validation for maternal records
        $maternalValidated = null;
        if ($type === 'maternal') {
            $maternalValidated = $request->validate([
                'pregnancy_stage'       => 'required|in:first_trimester,second_trimester,third_trimester',
                'last_checkup_date'     => 'required|date',
                'expected_delivery_date' => 'required|date|after:last_checkup_date',
            ]);
        }

        // 2. Create the patient in the database
        $patient = Patient::create($validated);

        // 3. If child nutrition type, create linked ChildNutritionRecord
        if ($type === 'child' && $childValidated) {
            ChildNutritionRecord::create([
                'patient_id'         => $patient->id,
                'full_name'          => $validated['name'],
                'age_months'         => $childValidated['age_months'],
                'barangay'           => $validated['barangay'],
                'weight_kg'          => $childValidated['weight_kg'],
                'height_cm'          => $childValidated['height_cm'],
                'last_weigh_in_date' => $childValidated['last_weigh_in_date'],
                // nutritional_status will be calculated by the observer
            ]);
        }

        // 3b. If maternal type, create linked MaternalRecord
        if ($type === 'maternal' && $maternalValidated) {
            // Calculate age from birthdate
            $age = \Carbon\Carbon::parse($validated['birthdate'])->age;

            MaternalRecord::create([
                'patient_id'              => $patient->id,
                'full_name'               => $validated['name'],
                'age'                     => $age,
                'address'                 => $validated['barangay'],
                'contact_number'          => $validated['contact_number'],
                'pregnancy_stage'         => $maternalValidated['pregnancy_stage'],
                'last_checkup_date'       => $maternalValidated['last_checkup_date'],
                'expected_delivery_date'  => $maternalValidated['expected_delivery_date'],
                // risk_level will be calculated by the observer
            ]);
        }

        // 4. Redirect back with a success message
        return redirect()->route('patients.index')->with('success', 'New patient added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'birthdate'      => 'required|date',
            'category'       => 'required|in:pregnant,child',
            'barangay'       => 'required|string',
            'contact_number' => 'required|string',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.show', $patient->id)->with('success', 'Patient updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully!');
    }
}

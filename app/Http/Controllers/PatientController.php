<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
class PatientController extends Controller
{
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
        $type = $request->query('type', 'pregnant');
        if (!in_array($type, ['pregnant', 'malnourished'])) {
            $type = 'pregnant';
        }

        return view('patients.create', ['type' => $type]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the data (Important for clean data!)
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category'       => 'required|in:pregnant,child',
            'barangay'       => 'required|string',
            'contact_number' => 'required|string',
        ]);

        // 2. Create the patient in the database
        Patient::create($validated);

        // 3. Redirect back with a success message
        return redirect()->route('patients.index')->with('success', 'New patient added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

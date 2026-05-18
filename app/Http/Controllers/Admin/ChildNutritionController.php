<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ChildNutritionRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildNutritionController extends Controller
{
    /**
     * Display all child nutrition records with search and filtering
     */
    public function index(Request $request)
    {
        $query = ChildNutritionRecord::with('patient')->withTrashed();

        // Search by full name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('full_name', 'like', '%' . $search . '%')
                    ->orWhereHas('patient', fn ($patientQuery) => $patientQuery->where('name', 'like', '%' . $search . '%'));
            });
        }

        // Filter by nutritional status
        if ($request->filled('nutritional_status')) {
            $query->where('nutritional_status', $request->nutritional_status);
        }

        // Dashboard filter (via query parameter)
        if ($request->filled('filter')) {
            $query->where('nutritional_status', $request->filter);
        }

        if (!$request->filled('show_archived')) {
            $query->whereNull('deleted_at');
        }

        // Get paginated results (15 per page)
        $records = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.child-nutrition.index', compact('records'));
    }

    /**
     * Store a new child nutrition record
     * Automatically creates or links to a Patient record
     * Nutritional status is automatically calculated by the observer
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age_months' => 'required|integer|min:0|max:180',
            'barangay' => 'required|string|max:255',
            'weight_kg' => 'required|numeric|min:0|max:100',
            'height_cm' => 'required|numeric|min:0|max:200',
            'last_weigh_in_date' => 'required|date|before_or_equal:today',
        ]);

        DB::transaction(function () use ($validated) {
            $patient = Patient::findOrCreateForModule([
                'name' => $validated['full_name'],
                'birthdate' => now()->subMonths($validated['age_months'])->toDateString(),
                'category' => 'child',
                'barangay' => $validated['barangay'],
                'contact_number' => 'N/A',
            ]);

            ChildNutritionRecord::create([
                'patient_id' => $patient->id,
                'full_name' => $patient->name,
                'age_months' => $validated['age_months'],
                'barangay' => $patient->barangay,
                'weight_kg' => $validated['weight_kg'],
                'height_cm' => $validated['height_cm'],
                'last_weigh_in_date' => $validated['last_weigh_in_date'],
                // nutritional_status will be auto-calculated by observer
            ]);
        });

        // Redirect back with success message
        return redirect()->route('child-nutrition.index')
                        ->with('success', 'Child nutrition record added successfully! Patient automatically linked.');
    }

    public function show(ChildNutritionRecord $childNutritionRecord)
    {
        $childNutritionRecord->load('patient');

        return view('admin.child-nutrition.show', [
            'record' => $childNutritionRecord,
        ]);
    }

    public function edit(ChildNutritionRecord $childNutritionRecord)
    {
        $childNutritionRecord->load('patient');

        return view('admin.child-nutrition.edit', [
            'record' => $childNutritionRecord,
        ]);
    }

    public function update(Request $request, ChildNutritionRecord $childNutritionRecord)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age_months' => 'required|integer|min:0|max:180',
            'barangay' => 'required|string|max:255',
            'weight_kg' => 'required|numeric|min:0.1|max:100',
            'height_cm' => 'required|numeric|min:0.1|max:200',
            'last_weigh_in_date' => 'required|date|before_or_equal:today',
        ]);

        DB::transaction(function () use ($childNutritionRecord, $validated) {
            $patient = $childNutritionRecord->patient ?: Patient::findOrCreateForModule([
                'name' => $validated['full_name'],
                'birthdate' => now()->subMonths($validated['age_months'])->toDateString(),
                'category' => 'child',
                'barangay' => $validated['barangay'],
                'contact_number' => 'N/A',
            ]);

            $patient->update([
                'name' => $validated['full_name'],
                'birthdate' => $patient->birthdate ?? now()->subMonths($validated['age_months'])->toDateString(),
                'category' => 'child',
                'barangay' => $validated['barangay'],
            ]);

            $childNutritionRecord->update([
                'patient_id' => $patient->id,
                'full_name' => $patient->name,
                'age_months' => $validated['age_months'],
                'barangay' => $patient->barangay,
                'weight_kg' => $validated['weight_kg'],
                'height_cm' => $validated['height_cm'],
                'last_weigh_in_date' => $validated['last_weigh_in_date'],
            ]);
        });

        return redirect()->route('child-nutrition.index')
            ->with('success', 'Child nutrition record updated successfully!');
    }

    public function destroy(ChildNutritionRecord $childNutritionRecord)
    {
        $childNutritionRecord->delete();

        return redirect()->route('child-nutrition.index')
            ->with('success', 'Child nutrition record archived successfully!');
    }

    public function restore(string $id)
    {
        $record = ChildNutritionRecord::onlyTrashed()->findOrFail($id);
        $record->restore();

        return redirect()->route('child-nutrition.index', ['show_archived' => 1])
            ->with('success', 'Child nutrition record restored successfully!');
    }

    /**
     * Generate a PDF health report for a child nutrition record
     */
    public function generateChildHealthReport($id)
    {
        $record = ChildNutritionRecord::with('patient')->findOrFail($id);

        // Calculate BMI for the report
        $heightM = $record->height_cm / 100;
        $bmi = $record->weight_kg / ($heightM * $heightM);

        // Prepare data for the PDF
        $data = [
            'record' => $record,
            'bmi' => round($bmi, 2),
            'rhuName' => 'Rural Health Unit of Sierra Bullones',
            'reportDate' => now()->format('F d, Y'),
        ];

        // Generate PDF
        $pdf = Pdf::loadView('admin.child-nutrition.pdf-report', $data);

        // Return as download with a meaningful filename
        return $pdf->download('Child_Nutrition_Report_' . str($record->display_name)->replace(' ', '_') . '.pdf');
    }
}

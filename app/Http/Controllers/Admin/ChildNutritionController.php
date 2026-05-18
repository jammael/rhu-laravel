<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $query = ChildNutritionRecord::with('patient');

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
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.child-nutrition.pdf-report', $data);

        // Return as download with a meaningful filename
        return $pdf->download("child_health_report_{$record->id}_{$record->display_name}.pdf");
    }
}

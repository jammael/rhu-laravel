<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildNutritionRecord;
use Illuminate\Http\Request;

class ChildNutritionController extends Controller
{
    /**
     * Display all child nutrition records with search and filtering
     */
    public function index(Request $request)
    {
        $query = ChildNutritionRecord::query();

        // Search by full name
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
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
     * Nutritional status is automatically calculated by the observer
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        // Note: nutritional_status is NOT required - it's auto-calculated by the observer
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age_months' => 'required|integer|min:0|max:180',
            'barangay' => 'required|string|max:255',
            'weight_kg' => 'required|numeric|min:0|max:100',
            'height_cm' => 'required|numeric|min:0|max:200',
            'last_weigh_in_date' => 'required|date|before_or_equal:today',
        ]);

        // Create the child nutrition record
        // Observer will automatically set nutritional_status
        ChildNutritionRecord::create($validated);

        // Redirect back with success message
        return redirect()->route('child-nutrition.index')
                        ->with('success', 'Child nutrition record added successfully!');
    }

    /**
     * Generate a PDF health report for a child nutrition record
     */
    public function generateChildHealthReport($id)
    {
        $record = ChildNutritionRecord::findOrFail($id);

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
        return $pdf->download("child_health_report_{$record->id}_{$record->full_name}.pdf");
    }
}


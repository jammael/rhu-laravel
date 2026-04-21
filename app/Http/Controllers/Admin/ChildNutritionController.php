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

        // Dashboard filter
        if ($request->filled('filter')) {
            match ($request->filter) {
                'normal' => $query->where('nutritional_status', 'normal'),
                'underweight' => $query->where('nutritional_status', 'underweight'),
                'severely_underweight' => $query->where('nutritional_status', 'severely_underweight'),
                default => $query,
            };
        }

        // Get paginated results (15 per page)
        $records = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.child-nutrition.index', compact('records'));
    }

    /**
     * Store a new child nutrition record
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
            'nutritional_status' => 'required|in:normal,underweight,severely_underweight',
            'last_weigh_in_date' => 'required|date|before_or_equal:today',
        ]);

        // Create the child nutrition record
        ChildNutritionRecord::create($validated);

        // Redirect back with success message
        return redirect()->route('child-nutrition.index')
                        ->with('success', 'Child nutrition record added successfully!');
    }
}

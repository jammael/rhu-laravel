<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaternalRecord;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MaternalController extends Controller
{
    /**
     * Display all maternal records with search and filtering
     */
    public function index(Request $request)
    {
        $query = MaternalRecord::withTrashed();

        // Search by full name
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        // Filter by risk level (from search form)
        if ($request->filled('risk_level')) {
            $query->where('risk_level', $request->risk_level);
        }

        // Dashboard filter (from cards)
        if ($request->filled('filter')) {
            $riskLevelMap = [
                'high_risk' => 'high',
                'medium_risk' => 'medium',
                'low_risk' => 'low',
            ];

            if (isset($riskLevelMap[$request->filter])) {
                $query->where('risk_level', $riskLevelMap[$request->filter]);
            }
        }

        // Filter to show only active records by default
        if (!$request->filled('show_archived')) {
            $query->whereNull('deleted_at');
        }

        // Get paginated results (15 per page)
        $records = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.maternal.index', compact('records'));
    }

    /**
     * Show a single maternal record
     */
    public function show(MaternalRecord $maternalRecord)
    {
        return view('admin.maternal.show', compact('maternalRecord'));
    }

    /**
     * Show the form for editing a maternal record
     */
    public function edit(MaternalRecord $maternalRecord)
    {
        return view('admin.maternal.edit', compact('maternalRecord'));
    }

    /**
     * Store a new maternal record
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:50',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|regex:/^[0-9\-\+\s]{7,}$/',
            'pregnancy_stage' => 'required|in:first_trimester,second_trimester,third_trimester',
            'last_checkup_date' => 'required|date|before_or_equal:today',
            'expected_delivery_date' => 'required|date|after:last_checkup_date',
            'risk_level' => 'required|in:low,medium,high',
        ]);

        // Create the maternal record
        MaternalRecord::create($validated);

        // Redirect back with success message
        return redirect()->route('maternal.index')
                        ->with('success', 'Maternal record added successfully!');
    }

    /**
     * Update a maternal record
     */
    public function update(Request $request, MaternalRecord $maternalRecord)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:50',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|regex:/^[0-9\-\+\s]{7,}$/',
            'pregnancy_stage' => 'required|in:first_trimester,second_trimester,third_trimester',
            'last_checkup_date' => 'required|date|before_or_equal:today',
            'expected_delivery_date' => 'required|date|after:last_checkup_date',
            'risk_level' => 'required|in:low,medium,high',
        ]);

        // Update the record
        $maternalRecord->update($validated);

        return redirect()->route('maternal.index')
                        ->with('success', 'Maternal record updated successfully!');
    }

    /**
     * Archive (soft delete) a maternal record
     */
    public function destroy(MaternalRecord $maternalRecord)
    {
        $maternalRecord->delete();

        return redirect()->route('maternal.index')
                        ->with('success', 'Maternal record archived successfully!');
    }

    /**
     * Restore a soft-deleted maternal record
     */
    public function restore(string $id)
    {
        $maternalRecord = MaternalRecord::onlyTrashed()->findOrFail($id);
        $maternalRecord->restore();

        return redirect()->route('maternal.index')
                        ->with('success', 'Maternal record restored successfully!');
    }

    /**
     * Generate PDF report for a maternal record
     */
    public function generatePDF(MaternalRecord $maternalRecord)
    {
        $data = [
            'record' => $maternalRecord,
            'rhuName' => 'Rural Health Unit - Maternal Care',
            'reportDate' => now()->format('F d, Y h:i A'),
        ];

        $pdf = PDF::loadView('admin.maternal.pdf-report', $data);

        return $pdf->download('maternal_record_' . $maternalRecord->id . '_' . now()->format('Y-m-d') . '.pdf');
    }
}


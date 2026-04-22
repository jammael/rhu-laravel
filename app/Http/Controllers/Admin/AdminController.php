<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaternalRecord;
use App\Models\ChildNutritionRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        // Maternal Data
        $totalPregnancies = MaternalRecord::count();
        $highRiskCount = MaternalRecord::where('risk_level', 'high')->count();
        $mediumRiskCount = MaternalRecord::where('risk_level', 'medium')->count();

        // Child Nutrition Data
        $totalChildren = ChildNutritionRecord::count();
        $normalNutritionCount = ChildNutritionRecord::where('nutritional_status', 'normal')->count();
        $underweightCount = ChildNutritionRecord::where('nutritional_status', 'underweight')->count();
        $severelyUnderweightCount = ChildNutritionRecord::where('nutritional_status', 'severely_underweight')->count();

        // Patient Data
        $pregnantPatients = Patient::where('category', 'pregnant')->count();
        $malnourishedCount = Patient::where('category', 'child')->count();
        $totalPatients = Patient::count();

        // Get latest 5 maternal records for urgent health alerts
        $urgentAlerts = MaternalRecord::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.index', compact(
            'totalPregnancies',
            'highRiskCount',
            'mediumRiskCount',
            'totalChildren',
            'normalNutritionCount',
            'underweightCount',
            'severelyUnderweightCount',
            'urgentAlerts',
            'pregnantPatients',
            'malnourishedCount',
            'totalPatients'
        ));
    }
    //End Method
}

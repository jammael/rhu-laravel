<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaternalRecord;
use App\Models\ChildNutritionRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        // Maternal Data
        $totalPregnancies = MaternalRecord::count();
        $lowRiskCount = MaternalRecord::where('risk_level', 'low')->count();
        $mediumRiskCount = MaternalRecord::where('risk_level', 'medium')->count();
        $highRiskCount = MaternalRecord::where('risk_level', 'high')->count();

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
        $urgentAlerts = MaternalRecord::with('patient')->orderBy('created_at', 'desc')->take(5)->get();

        // Nutritional Growth Trends - Last 3 Months
        $chartData = $this->getNutritionalGrowthTrends();

        return view('admin.index', compact(
            'totalPregnancies',
            'lowRiskCount',
            'mediumRiskCount',
            'highRiskCount',
            'totalChildren',
            'normalNutritionCount',
            'underweightCount',
            'severelyUnderweightCount',
            'urgentAlerts',
            'pregnantPatients',
            'malnourishedCount',
            'totalPatients',
            'chartData'
        ));
    }

    /**
     * Get nutritional growth trends for the last 3 months
     * Groups child nutrition records by month and counts normal vs underweight
     */
    private function getNutritionalGrowthTrends()
    {
        // Get data for the last 3 months
        $threeMonthsAgo = Carbon::now()->subMonths(3)->startOfMonth();
        $today = Carbon::now()->endOfDay();
        $driver = DB::connection()->getDriverName();
        $monthExpression = $driver === 'pgsql'
            ? "TO_CHAR(created_at, 'YYYY-MM')"
            : 'DATE_FORMAT(created_at, "%Y-%m")';
        $monthLabelExpression = $driver === 'pgsql'
            ? "TO_CHAR(created_at, 'Mon YYYY')"
            : 'DATE_FORMAT(created_at, "%b %Y")';

        // Query to get monthly nutrition data
        $trendData = ChildNutritionRecord::whereBetween('created_at', [$threeMonthsAgo, $today])
            ->select(
                DB::raw("{$monthExpression} as month"),
                DB::raw("{$monthLabelExpression} as month_label"),
                DB::raw("SUM(CASE WHEN nutritional_status = 'normal' THEN 1 ELSE 0 END) as normal_count"),
                DB::raw("SUM(CASE WHEN nutritional_status IN ('underweight', 'severely_underweight') THEN 1 ELSE 0 END) as underweight_count")
            )
            ->groupBy('month', 'month_label')
            ->orderBy('month', 'asc')
            ->get();

        // Build labels and datasets
        $labels = [];
        $normalData = [];
        $underweightData = [];

        foreach ($trendData as $data) {
            $labels[] = $data->month_label;
            $normalData[] = (int) $data->normal_count;
            $underweightData[] = (int) $data->underweight_count;
        }

        // Return as JSON-ready format
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Normal Status',
                    'data' => $normalData,
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#059669',
                    'borderWidth' => 1,
                    'borderRadius' => 4,
                ],
                [
                    'label' => 'Underweight (including Severely)',
                    'data' => $underweightData,
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#d97706',
                    'borderWidth' => 1,
                    'borderRadius' => 4,
                ]
            ]
        ];
    }
    //End Method
}

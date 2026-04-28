<?php

namespace App\Observers;

use App\Models\MaternalRecord;
use Carbon\Carbon;

class MaternalRecordObserver
{
    /**
     * Calculate risk level based on pregnancy stage, checkup timeliness, and age
     */
    public function saving(MaternalRecord $record): void
    {
        $record->risk_level = $this->calculateRiskLevel($record);
    }

    /**
     * Calculate risk level based on comprehensive maternal health assessment
     *
     * RISK FACTORS CONSIDERED:
     * 1. Maternal Age
     *    - Teenage (<20): High risk
     *    - Advanced maternal age (≥35): High risk
     *    - Optimal (20-34): Lower risk
     *
     * 2. Pregnancy Stage & Checkup Timeliness
     *    - 1st Trimester: Monthly checkup (≤30 days acceptable)
     *    - 2nd Trimester: Bi-weekly checkup (≤14 days acceptable)
     *    - 3rd Trimester: Weekly checkup (≤7 days - critical monitoring)
     *
     * 3. Cumulative Risk Assessment:
     *    - Multiple risk factors are combined for accurate prediction
     *    - 3rd trimester overdue checkups are flagged as HIGH RISK
     *    - Any combination of 2+ medium factors = MEDIUM RISK minimum
     *
     * @param MaternalRecord $record
     * @return string risk_level (low, medium, high)
     */
    private function calculateRiskLevel(MaternalRecord $record): string
    {
        $riskFactors = [];

        // ==================== FACTOR 1: AGE ASSESSMENT ====================
        $ageRisk = $this->assessAgeRisk($record->age);
        if ($ageRisk) {
            $riskFactors[] = $ageRisk;
        }

        // ==================== FACTOR 2: PREGNANCY STAGE & CHECKUP TIMELINESS ====================
        $checkupRisk = $this->assessCheckupTimeliness($record->pregnancy_stage, $record->last_checkup_date);
        if ($checkupRisk) {
            $riskFactors[] = $checkupRisk;
        }

        // ==================== FACTOR 3: HIGH-RISK PREGNANCY CONDITIONS ====================
        // 3rd Trimester is inherently higher risk (requires weekly monitoring)
        if ($record->pregnancy_stage === 'third_trimester') {
            $riskFactors[] = 'medium'; // 3rd trimester baseline
        }

        // ==================== COMBINED RISK ASSESSMENT ====================
        return $this->determineFinalRisk($riskFactors);
    }

    /**
     * Assess risk based on maternal age
     * WHO identifies teenage pregnancy and advanced maternal age as risk factors
     *
     * @param int $age
     * @return string|null
     */
    private function assessAgeRisk(int $age): ?string
    {
        if ($age < 20) {
            // Teenage pregnancy: Complications, anemia, preeclampsia more common
            return 'high';
        } elseif ($age >= 35) {
            // Advanced maternal age: Increased risk of complications
            return 'medium';
        }

        return null; // Optimal age (20-34)
    }

    /**
     * Assess risk based on checkup timeliness for each trimester
     *
     * Different trimesters have different recommended checkup frequencies:
     * - 1st Trimester (0-12 weeks): Monthly (every 30 days)
     * - 2nd Trimester (13-26 weeks): Bi-weekly (every 14 days)
     * - 3rd Trimester (27+ weeks): WEEKLY (every 7 days) - CRITICAL
     *
     * @param string $pregnancyStage
     * @param \Carbon\Carbon|string $lastCheckupDate
     * @return string|null
     */
    private function assessCheckupTimeliness(string $pregnancyStage, $lastCheckupDate): ?string
    {
        $lastCheckupDate = Carbon::parse($lastCheckupDate);
        $daysSinceCheckup = Carbon::now()->diffInDays($lastCheckupDate);

        switch ($pregnancyStage) {
            case 'first_trimester':
                // 1st Trimester: Monthly checkups (30 days acceptable)
                if ($daysSinceCheckup > 35) {
                    return 'medium'; // Overdue for first trimester
                }
                break;

            case 'second_trimester':
                // 2nd Trimester: Bi-weekly checkups (14 days acceptable)
                if ($daysSinceCheckup > 21) {
                    return 'medium'; // Overdue for second trimester
                }
                break;

            case 'third_trimester':
                // 3rd Trimester: WEEKLY checkups (7 days - CRITICAL)
                if ($daysSinceCheckup > 14) {
                    return 'high'; // OVERDUE - Critical in 3rd trimester!
                } elseif ($daysSinceCheckup > 9) {
                    return 'medium'; // At risk of missing weekly schedule
                }
                break;
        }

        return null; // On schedule
    }

    /**
     * Determine final risk level based on accumulated risk factors
     *
     * Risk Determination Logic:
     * - If ANY factor is HIGH → HIGH RISK
     * - If 2+ factors are MEDIUM → MEDIUM RISK
     * - If 1 factor is MEDIUM and no HIGH → MEDIUM RISK
     * - If all factors are LOW or no factors → LOW RISK
     *
     * @param array $riskFactors
     * @return string (low, medium, high)
     */
    private function determineFinalRisk(array $riskFactors): string
    {
        // Check for any HIGH risk factors
        if (in_array('high', $riskFactors)) {
            return 'high';
        }

        // Check for MEDIUM risk factors
        $mediumCount = count(array_filter($riskFactors, fn($f) => $f === 'medium'));
        if ($mediumCount >= 1) {
            return 'medium';
        }

        // Default to LOW risk if no concerning factors
        return 'low';
    }
}

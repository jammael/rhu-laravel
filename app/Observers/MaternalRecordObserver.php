<?php

namespace App\Observers;

use App\Models\MaternalRecord;

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
     * Calculate risk level based on:
     * 1. If patient is over 35 years old → at least Medium Risk
     * 2. If in 3rd Trimester and has missed monthly checkup → High Risk
     *
     * @param MaternalRecord $record
     * @return string risk_level (low, medium, high)
     */
    private function calculateRiskLevel(MaternalRecord $record): string
    {
        // Rule 1: If age is 35 or older, default to at least Medium Risk
        if ($record->age >= 35) {
            $baseRisk = 'medium';
        } else {
            $baseRisk = 'low';
        }

        // Rule 2: If in 3rd Trimester and has missed monthly checkup, escalate to High Risk
        if ($record->pregnancy_stage === 'third_trimester') {
            $daysOutOfCheckup = now()->diffInDays($record->last_checkup_date);

            // Monthly checkup threshold is 30 days; anything over 30 days is considered missed
            if ($daysOutOfCheckup > 30) {
                return 'high';
            }
        }

        return $baseRisk;
    }
}

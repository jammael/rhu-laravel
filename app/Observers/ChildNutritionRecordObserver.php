<?php

namespace App\Observers;

use App\Models\ChildNutritionRecord;

class ChildNutritionRecordObserver
{
    /**
     * Calculate nutritional status based on WHO/DOH Z-score standards
     * Using BMI and age-adjusted thresholds for children
     */
    public function saving(ChildNutritionRecord $record): void
    {
        $record->nutritional_status = $this->calculateNutritionalStatus(
            $record->weight_kg,
            $record->height_cm,
            $record->age_months
        );
    }

    /**
     * Calculate nutritional status using WHO Z-score standards
     *
     * @param float $weightKg Weight in kilograms
     * @param float $heightCm Height in centimeters
     * @param int $ageMonths Age in months
     * @return string nutritional_status (normal, underweight, severely_underweight)
     */
    private function calculateNutritionalStatus(float $weightKg, float $heightCm, int $ageMonths): string
    {
        // Calculate BMI
        $heightM = $heightCm / 100;
        $bmi = $weightKg / ($heightM * $heightM);

        // Get age-specific reference values based on WHO Child Growth Standards
        $referenceData = $this->getWHOReference($ageMonths);

        if (!$referenceData) {
            return 'normal'; // Default if age is outside standard range
        }

        // Calculate Z-score: (value - mean) / SD
        $zScore = ($bmi - $referenceData['mean']) / $referenceData['sd'];

        // Classify based on Z-score thresholds
        if ($zScore < -3) {
            return 'severely_underweight';
        } elseif ($zScore < -2) {
            return 'underweight';
        } else {
            return 'normal';
        }
    }

    /**
     * Get WHO reference values for BMI by age
     * Based on WHO Child Growth Standards (children 0-5 years)
     * Values are simplified averages for demonstration; use actual WHO tables for production
     *
     * @param int $ageMonths Age in months
     * @return array|null Array with 'mean' and 'sd' (standard deviation) or null if out of range
     */
    private function getWHOReference(int $ageMonths): ?array
    {
        // Simplified WHO BMI-for-age reference data for children
        // Format: age_range => ['mean' => BMI mean, 'sd' => standard deviation]
        // These are approximate values; real implementation should use official WHO tables

        $ageGroups = [
            // 0-6 months
            [0, 6, ['mean' => 17.5, 'sd' => 1.2]],
            // 6-12 months
            [6, 12, ['mean' => 18.0, 'sd' => 1.3]],
            // 12-24 months
            [12, 24, ['mean' => 17.5, 'sd' => 1.4]],
            // 24-36 months
            [24, 36, ['mean' => 16.9, 'sd' => 1.3]],
            // 36-48 months
            [36, 48, ['mean' => 16.2, 'sd' => 1.2]],
            // 48-60 months
            [48, 60, ['mean' => 15.8, 'sd' => 1.1]],
            // 60-72 months (5 years)
            [60, 72, ['mean' => 15.5, 'sd' => 1.2]],
        ];

        foreach ($ageGroups as [$minAge, $maxAge, $reference]) {
            if ($ageMonths >= $minAge && $ageMonths < $maxAge) {
                return $reference;
            }
        }

        // For children over 5 years (> 60 months), use extended reference
        if ($ageMonths >= 72 && $ageMonths <= 180) {
            return ['mean' => 15.8, 'sd' => 1.3]; // Approximate for school-age
        }

        return null;
    }
}

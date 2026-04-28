<?php

namespace App\Console\Commands;

use App\Models\MaternalRecord;
use Illuminate\Console\Command;

class RecalculateMaternalRiskLevels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recalculate-maternal-risk-levels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate risk levels for all maternal records based on WHO guidelines';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting recalculation of maternal record risk levels...');

        try {
            $totalRecords = MaternalRecord::count();

            if ($totalRecords === 0) {
                $this->info('No maternal records found to update.');
                return self::SUCCESS;
            }

            $this->info("Found {$totalRecords} maternal records to process.");

            // Create progress bar
            $bar = $this->output->createProgressBar($totalRecords);
            $bar->start();

            MaternalRecord::chunk(100, function ($records) use ($bar) {
                foreach ($records as $record) {
                    // Trigger observer to recalculate risk level
                    $record->save();
                    $bar->advance();
                }
            });

            $bar->finish();
            $this->newLine(2);

            $this->info("✓ Successfully recalculated risk levels for {$totalRecords} maternal records.");
            $this->line('Risk calculation now based on WHO maternal health guidelines:');
            $this->line('  • Age assessment (teenage vs advanced maternal age)');
            $this->line('  • Pregnancy stage with trimester-specific checkup frequencies');
            $this->line('  • Cumulative risk factor analysis');

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error during recalculation: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}

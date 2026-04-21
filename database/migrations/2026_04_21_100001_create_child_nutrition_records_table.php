<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('child_nutrition_records', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('age_months'); // Child's age in months
            $table->string('barangay');
            $table->decimal('weight_kg', 5, 2); // Weight in kilograms
            $table->decimal('height_cm', 5, 2); // Height in centimeters
            $table->enum('nutritional_status', ['normal', 'underweight', 'severely_underweight'])->default('normal');
            $table->date('last_weigh_in_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_nutrition_records');
    }
};

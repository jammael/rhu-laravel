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
    Schema::create('patients', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->enum('category', ['pregnant', 'child']); // To filter between the two
        $table->date('birthdate');
        $table->string('barangay'); // Important for Sierra Bullones local tracking
        $table->string('contact_number'); // For your SMS Notification feature later
        $table->text('health_remarks')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};

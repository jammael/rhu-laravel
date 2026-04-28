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
        Schema::table('maternal_records', function (Blueprint $table) {
            // Add patient_id foreign key column
            $table->unsignedBigInteger('patient_id')->nullable()->after('id');

            // Create foreign key constraint
            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maternal_records', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['patient_id']);
            // Drop column
            $table->dropColumn('patient_id');
        });
    }
};

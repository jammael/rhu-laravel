<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            if (! Schema::hasColumn('patients', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        Schema::table('child_nutrition_records', function (Blueprint $table) {
            if (! Schema::hasColumn('child_nutrition_records', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('child_nutrition_records', function (Blueprint $table) {
            if (Schema::hasColumn('child_nutrition_records', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });

        Schema::table('patients', function (Blueprint $table) {
            if (Schema::hasColumn('patients', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};

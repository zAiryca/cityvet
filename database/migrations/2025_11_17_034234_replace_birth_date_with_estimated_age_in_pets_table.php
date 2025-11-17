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
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn('birth_date');
            $table->integer('estimated_age_years')->nullable()->after('gender');
            $table->integer('estimated_age_months')->nullable()->after('estimated_age_years');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn(['estimated_age_years', 'estimated_age_months']);
            $table->date('birth_date')->nullable()->after('gender');
        });
    }
};

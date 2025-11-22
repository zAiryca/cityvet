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
        Schema::table('pet_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('pet_registrations', 'denial_reason')) {
                $table->text('denial_reason')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pet_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('pet_registrations', 'denial_reason')) {
                $table->dropColumn('denial_reason');
            }
        });
    }
};

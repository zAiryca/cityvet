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
        Schema::table('pet_requests', function (Blueprint $table) {
            $table->enum('denial_type', ['manual', 'automatic'])->nullable()->after('denial_reason')->comment('Type of denial: manual (admin) or automatic (system)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pet_requests', function (Blueprint $table) {
            $table->dropColumn('denial_type');
        });
    }
};

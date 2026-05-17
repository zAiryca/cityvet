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
            // Update status enum to include unclaimed and unadopted
            $table->enum('status', ['registered', 'impounded', 'adoptable', 'adopted', 'claimed', 'unclaimed', 'unadopted'])->default('registered')->change();

            // Drop unused columns
            $table->dropColumn(['decision_date', 'urgent_deadline']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            // Revert status enum
            $table->enum('status', ['registered', 'impounded', 'adoptable', 'adopted', 'claimed'])->default('registered')->change();

            // Add back the columns
            $table->date('decision_date')->nullable();
            $table->date('urgent_deadline')->nullable();
        });
    }
};

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
            $table->enum('adoption_reason', ['surrendered_by_owner', 'remained_unclaimed', 'found_by_citizen', 'other'])->nullable();
            $table->text('adoption_reason_other')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn(['adoption_reason', 'adoption_reason_other']);
        });
    }
};

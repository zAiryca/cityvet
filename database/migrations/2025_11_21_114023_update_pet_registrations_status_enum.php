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
            // Modify the enum to include 'denied' status
            $table->enum('status', ['pending', 'registered', 'denied'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pet_registrations', function (Blueprint $table) {
            $table->enum('status', ['pending', 'registered'])->default('pending')->change();
        });
    }
};

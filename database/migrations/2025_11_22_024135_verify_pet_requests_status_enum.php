<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure the status enum includes 'completed' value for finalizing adoptions/claims
        DB::statement("ALTER TABLE pet_requests MODIFY COLUMN status ENUM('pending', 'approved', 'denied', 'completed') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum without 'completed'
        DB::statement("ALTER TABLE pet_requests MODIFY COLUMN status ENUM('pending', 'approved', 'denied') DEFAULT 'pending'");
    }
};

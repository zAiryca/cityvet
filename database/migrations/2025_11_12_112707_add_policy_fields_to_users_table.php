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
        // Add the missing columns to the existing 'users' table
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('terms')->default(false)->after('role');
            $table->boolean('privacy')->default(false)->after('terms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the columns if the migration is rolled back
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('terms');
            $table->dropColumn('privacy');
        });
    }
};

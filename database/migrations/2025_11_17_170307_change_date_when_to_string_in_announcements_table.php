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
        Schema::table('announcements', function (Blueprint $table) {
            // Change the column type from DATETIME/TIMESTAMP to string
            $table->string('date_when')->change();
        });
    }

    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Change it back to a DATETIME if needed for rollbacks
            $table->dateTime('date_when')->change();
        });
    }
};

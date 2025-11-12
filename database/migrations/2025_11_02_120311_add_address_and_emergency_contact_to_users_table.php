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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'emergency_contact')) {
                $table->string('emergency_contact')->nullable()->after('contact_number');
            }

            if (!Schema::hasColumn('users', 'street')) {
                $table->string('street')->nullable()->after('province');
            }

            if (!Schema::hasColumn('users', 'zip_code')) {
                $table->string('zip_code')->nullable()->after('street');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'emergency_contact')) {
                $table->dropColumn('emergency_contact');
            }

            if (Schema::hasColumn('users', 'street')) {
                $table->dropColumn('street');
            }

            if (Schema::hasColumn('users', 'zip_code')) {
                $table->dropColumn('zip_code');
            }
        });
    }
};

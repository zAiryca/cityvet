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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id');
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('last_name')->after('middle_name');
            $table->string('contact_number')->nullable()->after('last_name');
            $table->string('street')->nullable()->after('contact_number');
            $table->string('barangay')->nullable()->after('street');
            $table->string('city_municipality')->nullable()->after('barangay');
            $table->string('province')->nullable()->after('city_municipality');
        });

        // Create lower-case generated columns for case-insensitive unique index (MySQL)
        // This needs to be in a separate Schema call to ensure the columns exist first.
        Schema::table('users', function (Blueprint $table) {
            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                // Add generated (virtual) columns and unique index
                DB::statement('ALTER TABLE users ADD COLUMN first_name_lower VARCHAR(255) GENERATED ALWAYS AS (LOWER(first_name)) VIRTUAL');
                DB::statement('ALTER TABLE users ADD COLUMN last_name_lower VARCHAR(255) GENERATED ALWAYS AS (LOWER(last_name)) VIRTUAL');
                DB::statement('CREATE UNIQUE INDEX users_first_last_unique ON users (first_name_lower, last_name_lower)');
            } else {
                // Fallback: create a composite index (case-sensitive depending on DB collation)
                $table->unique(['first_name', 'last_name'], 'users_first_last_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                // Check if index exists before dropping
                $indexes = Schema::getConnection()->select("SHOW INDEX FROM users WHERE Key_name = 'users_first_last_unique'");
                if (!empty($indexes)) {
                    DB::statement('DROP INDEX users_first_last_unique ON users');
                }
                // Check if columns exist before dropping
                if (Schema::hasColumn('users', 'first_name_lower')) {
                    DB::statement('ALTER TABLE users DROP COLUMN first_name_lower');
                }
                if (Schema::hasColumn('users', 'last_name_lower')) {
                    DB::statement('ALTER TABLE users DROP COLUMN last_name_lower');
                }
            } else {
                $table->dropUnique('users_first_last_unique');
            }

            // Check each column before dropping it to make the migration idempotent
            if (Schema::hasColumn('users', 'province')) {
                $table->dropColumn('province');
            }
            if (Schema::hasColumn('users', 'city_municipality')) {
                $table->dropColumn('city_municipality');
            }
            if (Schema::hasColumn('users', 'barangay')) {
                $table->dropColumn('barangay');
            }
            if (Schema::hasColumn('users', 'street')) {
                $table->dropColumn('street');
            }
            if (Schema::hasColumn('users', 'contact_number')) {
                $table->dropColumn('contact_number');
            }
            if (Schema::hasColumn('users', 'last_name')) {
                $table->dropColumn('last_name');
            }
            if (Schema::hasColumn('users', 'middle_name')) {
                $table->dropColumn('middle_name');
            }
            if (Schema::hasColumn('users', 'first_name')) {
                $table->dropColumn('first_name');
            }
        });
    }
};

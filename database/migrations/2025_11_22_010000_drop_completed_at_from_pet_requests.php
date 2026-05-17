<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Drop the `completed_at` column from `pet_requests` if it exists.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('pet_requests', 'completed_at')) {
            Schema::table('pet_requests', function (Blueprint $table) {
                $table->dropColumn('completed_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     * Re-add the `completed_at` column as nullable timestamp after `admin_notes`.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('pet_requests', 'completed_at')) {
            Schema::table('pet_requests', function (Blueprint $table) {
                $table->timestamp('completed_at')->nullable()->after('admin_notes');
            });
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posters', function (Blueprint $table) {
            if (!Schema::hasColumn('posters', 'photos')) {
                $table->json('photos')->nullable()->after('photo');
            }
        });
    }

    public function down()
    {
        Schema::table('posters', function (Blueprint $table) {
            if (Schema::hasColumn('posters', 'photos')) {
                $table->dropColumn('photos');
            }
        });
    }
};

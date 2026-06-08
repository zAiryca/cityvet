<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('posters', function (Blueprint $table) {
            if (!Schema::hasColumn('posters', 'social_media_links')) {
                $table->json('social_media_links')->nullable()->after('photos');
            }
        });
    }

    public function down()
    {
        Schema::table('posters', function (Blueprint $table) {
            if (Schema::hasColumn('posters', 'social_media_links')) {
                $table->dropColumn('social_media_links');
            }
        });
    }
};

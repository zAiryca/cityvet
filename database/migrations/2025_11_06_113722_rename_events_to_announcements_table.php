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
        // Rename events table to announcements
        Schema::rename('events', 'announcements');

        // Add type column to announcements table
        Schema::table('announcements', function (Blueprint $table) {
            $table->enum('type', ['event', 'notice', 'trivia'])->default('event')->after('title');
        });

        // Rename event_registrations table to announcement_registrations
        Schema::rename('event_registrations', 'announcement_registrations');

        // Update foreign key in announcement_registrations
        Schema::table('announcement_registrations', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->foreignId('announcement_id')->constrained('announcements')->onDelete('cascade');
            $table->dropColumn('event_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes
        Schema::table('announcement_registrations', function (Blueprint $table) {
            $table->dropForeign(['announcement_id']);
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->dropColumn('announcement_id');
        });

        Schema::rename('announcement_registrations', 'event_registrations');

        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::rename('announcements', 'events');
    }
};

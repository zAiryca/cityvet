<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
              $table->id();
              $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Add FK to users
              $table->foreignId('event_id')->constrained('events')->onDelete('cascade');  // FK to events
              $table->foreignId('pet_id')->nullable()->constrained('pets')->onDelete('set null');  // Optional pet
              $table->text('notes')->nullable();
              $table->timestamps();
              $table->softDeletes();
              // Unique: Prevent duplicate registrations
              $table->unique(['user_id', 'event_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
};

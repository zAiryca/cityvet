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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Admin creator
            $table->string('title');  // What
            $table->text('description');
            $table->enum('type', ['event', 'notice', 'trivia'])->default('event');
            $table->dateTime('event_date')->nullable();  // When (nullable for notices/trivia)
            $table->string('location')->nullable();  // Where (nullable for notices/trivia)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};

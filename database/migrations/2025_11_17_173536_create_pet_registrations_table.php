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
        Schema::create('pet_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('pet_name');
            $table->enum('species', ['Canine', 'Feline']);
            $table->string('breed');
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female', 'unknown']);
            $table->json('color_markings')->nullable(); // Store as JSON array
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['pending', 'registered'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_registrations');
    }
};

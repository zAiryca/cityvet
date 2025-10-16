<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_requests', function (Blueprint $table) {
            $table->id();

            // Link to user who made the request
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Polymorphic relationship fields
            // These allow this request to belong to different models (e.g., Pet, Event)
            $table->unsignedBigInteger('requestable_id')->nullable();
            $table->string('requestable_type')->nullable();

            // Request details
            $table->enum('type', ['claim', 'adopt', 'register']);
            $table->enum('status', ['pending', 'approved', 'denied'])->default('pending');
            $table->text('reason');
            $table->string('contact_info');
            $table->text('admin_notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Index for faster polymorphic lookups
            $table->index(['requestable_type', 'requestable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_requests');
    }
};

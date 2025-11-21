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
        if (!Schema::hasTable('pet_requests')) {
            Schema::create('pet_requests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->morphs('requestable'); // polymorphic: requestable_id, requestable_type
                $table->enum('type', ['claim', 'adopt', 'register'])->default('adopt');
                $table->enum('status', ['pending', 'approved', 'denied', 'completed'])->default('pending');
                $table->text('reason')->nullable();
                $table->string('contact_info')->nullable();
                $table->json('photos')->nullable();
                $table->json('additional_data')->nullable();
                $table->text('admin_notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_requests');
    }
};

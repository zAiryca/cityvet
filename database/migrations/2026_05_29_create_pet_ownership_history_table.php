<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_ownership_history', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Adoption/Claim details
            $table->enum('type', ['adopted', 'claimed'])->default('adopted');
            $table->date('assigned_date'); // When they adopted/claimed the pet

            // Return details (nullable - only filled when pet is returned)
            $table->date('return_date')->nullable(); // When they brought it back
            $table->enum('return_reason', [
                'owner_relocation',
                'owner_illness_death',
                'financial_hardship',
                'housing_restriction',
                'lifestyle_change',
                'incompatibility_pets',
                'incompatibility_children',
                'allergies',
                'space_exercise',
                'behavioral_issues',
                'other'
            ])->nullable();
            $table->text('return_reason_other')->nullable(); // Store the human-readable label
            $table->text('return_notes')->nullable(); // Additional notes about why returned

            // Adoption/claim reason (for reference)
            $table->text('adoption_reason')->nullable();
            $table->text('adoption_reason_other')->nullable();
            $table->text('adoption_notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_ownership_history');
    }
};

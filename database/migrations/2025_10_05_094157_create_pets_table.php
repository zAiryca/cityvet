<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
          //binago //
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Owner (for registered/claimed/adopted)
            $table->string('name');  // Or code name
            $table->string('species');  // e.g., Dog, Cat
            $table->string('breed');
            $table->enum('gender', ['male', 'female', 'unknown']);
            $table->text('color_markings');  // e.g., "Black with white spots"
            $table->text('description')->nullable();
            $table->string('photo')->nullable();  // Path to uploaded image
            $table->enum('status', ['registered', 'impounded', 'adoptable', 'adopted', 'claimed'])->default('registered');
            $table->date('impounded_date')->nullable();  // For impounded/adoptable
            $table->integer('remaining_days')->nullable();  // Calculated, but store for simplicity
            $table->date('urgent_deadline')->nullable();  // For urgent adoptable
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pets');
    }
};

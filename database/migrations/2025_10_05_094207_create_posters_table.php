<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['lost', 'found']);
            $table->string('pet_name');  // Name for lost, code for found
            $table->string('species');
            $table->string('breed');
            $table->enum('gender', ['male', 'female', 'unknown']);
            $table->text('color_markings');
            $table->date('date_lost_found');
            $table->text('last_seen')->nullable();  // For lost
            $table->text('found_at')->nullable();  // For found
            $table->string('photo');
            $table->text('contact_info');  // Phone/email
            $table->decimal('reward', 8, 2)->nullable();  // Optional
            $table->boolean('approved')->default(false);  // Admin approval
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posters');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Admin creator
            $table->string('title');  // What
            $table->text('description');
            $table->dateTime('event_date');  // When
            $table->string('location');  // Where
             $table->integer('capacity')->default(50);
            $table->timestamps();
             $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};

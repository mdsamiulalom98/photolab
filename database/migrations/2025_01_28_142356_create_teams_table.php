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
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->length(155);
            $table->string('designation')->length(55);
            $table->string('email')->length(55);
            $table->string('phone')->length(25);
            $table->string('facebook')->length(99)->nullable();
            $table->string('youtube')->length(99)->nullable();
            $table->string('twitter')->length(99)->nullable();
            $table->string('linked_in')->length(99)->nullable();
            $table->string('instagram')->length(99)->nullable();
            $table->string('pinterest')->length(99)->nullable();
            $table->text('image');
            $table->tinyInteger('status')->length(25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};

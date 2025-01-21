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
        Schema::create('trial_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('country');
            $table->string('company');
            $table->string('website');
            $table->string('image_size');
            $table->string('width');
            $table->string('height');
            $table->string('quantity');
            $table->string('margin');
            $table->string('message');
            $table->string('pre_delivery_time');
            $table->json('services');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trial_orders');
    }
};

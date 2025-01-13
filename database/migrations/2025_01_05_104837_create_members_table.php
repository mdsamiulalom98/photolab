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
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->length('155');
            $table->string('slug')->length('155');
            $table->string('phone')->length('55');
            $table->string('email')->length('55');
            $table->float('balance')->default(0);
            $table->integer('district')->nullable();
            $table->integer('area')->nullable();
            $table->string('address')->nullable();
            $table->integer('verify')->nullable();
            $table->string('image')->default('public/uploads/default/user.png');
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('type')->default('buyer');
            $table->string('status')->length('55');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

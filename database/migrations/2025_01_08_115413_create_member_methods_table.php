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
        Schema::create('member_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('bkash')->length('11');
            $table->string('nagad')->length('11');
            $table->string('rocket')->length('11');
            $table->integer('bank_id');
            $table->string('branch')->length('155');
            $table->string('routing')->length('11');
            $table->string('account_name')->length('155');
            $table->string('default_method')->length('25');
            $table->string('payment_type')->length('55');
            $table->string('account_number')->length('25');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_methods');
    }
};

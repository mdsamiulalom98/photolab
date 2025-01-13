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
        Schema::create('member_payment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id');
            $table->integer('order_id');
            $table->integer('amount');
            $table->integer('payable_amount');
            $table->integer('withdraw_charge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_payment_details');
    }
};

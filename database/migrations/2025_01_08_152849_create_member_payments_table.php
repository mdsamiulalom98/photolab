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
        Schema::create('member_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id');
            $table->integer('member_id');
            $table->integer('amount');
            $table->integer('payable_amount');
            $table->integer('withdraw_charge');
            $table->string('payment_method');
            $table->string('member_note');
            $table->string('admin_note');
            $table->string('trx_id');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_payments');
    }
};

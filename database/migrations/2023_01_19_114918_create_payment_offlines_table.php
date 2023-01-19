<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_offlines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payable_id')->nullable();
            $table->string('payable_type')->default('cash');
            $table->string('booking_code');
            $table->unsignedBigInteger('order_offline_id');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('currency')->nullable();
            $table->bigInteger('amount');
            $table->string('discount_type')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('tax')->nullable();
            $table->string('status')->default('PENDING');
            $table->timestamps();

            $table->foreign('order_offline_id')->references('id')->on('order_offlines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_offlines');
    }
};

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
        Schema::create('ewallets', function (Blueprint $table) {
            $table->id();
            $table->string('ewallet_id');
            $table->unsignedBigInteger('order_id');
            $table->string('channel_code');
            $table->string('payment_time')->nullable();
            $table->string('mobile_number');
            $table->string('success_redirect_url')->nullable();
            $table->string('desktop_web_checkout_url')->nullable();
            $table->string('mobile_web_checkout_url')->nullable();
            $table->string('callback_url')->nullable();
            $table->json("payload");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ewallets');
    }
};

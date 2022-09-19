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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->foreignId('order_id')->onDelete('cascade');
            $table->foreignId('payment_id')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->unsignedBigInteger('reason_id')->nullable();
            $table->longText('detail')->nullable();
            $table->date('refund_request_date')->nullable();
            $table->date('refund_action_date')->nullable();
            $table->string('refund_number')->nullable();
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
        Schema::dropIfExists('refunds');
    }
};

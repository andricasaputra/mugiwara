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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->index();
            $table->unsignedBigInteger('accomodation_id')->index();
            $table->unsignedBigInteger('room_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->date('check_in_date')->nullable();
            $table->time('check_in_time')->nullable();
            $table->integer('stay_day')->nullable()->default(1);
            $table->integer('total_guest')->default(1);
            $table->string('normal_price');
            $table->string('discount_type')->nullable();
            $table->string('discount_percent')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('total_price');
            $table->timestamps();
            
            $table->foreign('accomodation_id')->references('id')->on('accomodations')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

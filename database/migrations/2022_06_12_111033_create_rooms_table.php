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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->unsignedBigInteger('accomodation_id');
            $table->unsignedBigInteger('type_id');
            $table->integer('max_guest');
            $table->enum('status', ['available', 'booked'])->nullbale()->default('available');
            $table->date('booked_untill')->nullable();
            $table->integer('price');
            $table->enum('discount_type', ['flat', 'percent'])->nullable()->default(NULL);
            $table->string('discount_amount')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            $table->foreign('accomodation_id')->references('id')->on('accomodations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};

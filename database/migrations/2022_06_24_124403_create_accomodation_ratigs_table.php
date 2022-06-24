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
        Schema::create('accomodation_ratigs', function (Blueprint $table) {
            $table->id();
             $table->foreignId('accomodation_id')->references('id')->on('accomodations')->onDelete('cascade');
             $table->foreignId('rating_id')->references('id')->on('ratings')->onDelete('cascade');
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
        Schema::dropIfExists('accomodation_ratigs');
    }
};

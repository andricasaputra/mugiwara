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
        Schema::create('accomodation_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accomodation_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('accomodation_id')->references('id')->on('accomodations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accomodation_categories');
    }
};

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
        Schema::create('accomodations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('province_id')->nullable()->references('id')->on('provinces')->onDelete('cascade');
            $table->foreignId('regency_id')->nullable()->references('id')->on('regencies')->onDelete('cascade');
            $table->foreignId('districts_id')->nullable()->references('id')->on('districts')->onDelete('cascade');
            $table->longText('address');
            $table->longText('description')->nullable();
            $table->string('lang')->nullable();
            $table->string('lat')->nullable();
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
        Schema::dropIfExists('hotels');
    }
};

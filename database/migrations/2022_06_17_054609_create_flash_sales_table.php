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
        Schema::create('flash_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('accomodation_id');
            $table->unsignedInteger('room_id');
            $table->string('banner')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('discount_percent')->nullable();
            $table->decimal('discount_amount')->nullable();
            $table->enum('discount_type', ['flat', 'discount']);
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
        Schema::dropIfExists('flash_sales');
    }
};

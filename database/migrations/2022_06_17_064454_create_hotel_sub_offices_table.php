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
        Schema::create('hotel_sub_offices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('hotel_office_id');
            $table->string('mobile_number')->nullable();
            $table->longText('address');
            $table->string('type')->default('branch_office');
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
        Schema::dropIfExists('hotel_sub_offices');
    }
};

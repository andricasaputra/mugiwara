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
        Schema::create('payment_lists', function (Blueprint $table) {
            $table->id();
            $table->string('business_id');
            $table->boolean('is_livemode')->default(false);
            $table->string('channel_code');
            $table->string('name');
            $table->string('currency');
            $table->string('channel_category');
            $table->boolean('is_enabled')->default(false);
            $table->boolean('is_active')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('payment_lists');
    }
};

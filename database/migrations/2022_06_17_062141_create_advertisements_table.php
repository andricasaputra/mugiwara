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
        // Use morph polymorpic relations in images table
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('title')->nullable();
            $table->longText('body')->nullable();
            $table->string('slug');
            $table->tinyInteger('is_active')->default(1)->nullable();
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
        Schema::dropIfExists('advertisements');
    }
};

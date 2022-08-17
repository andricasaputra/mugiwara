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
        Schema::create('account_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'user_id' );
            $table->unsignedBigInteger( 'voucher_id' )->nullable();
            $table->bigInteger('before');
            $table->bigInteger('after');
            $table->string('mutation')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->string('transaction_number')->nullable();
            $table->timestamps();

            $table->unique( [ 'user_id', 'voucher_id' ] );

            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade');

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
        Schema::dropIfExists('account_points');
    }
};

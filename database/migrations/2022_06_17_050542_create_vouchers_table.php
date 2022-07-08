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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
    
            // The voucher code
            $table->string('code')->nullable();

            // The human readable voucher code name
            $table->string('name')->unique();

            // The description of the voucher - Not necessary 
            $table->text('description')->nullable();

            // The number of uses currently
            $table->integer('uses_count')->unsigned()->nullable();

            // The max uses this voucher has
            $table->integer('max_uses')->unsigned()->nullable();

            // How many times a user can use this voucher.
            $table->integer('max_uses_user')->unsigned()->nullable()->default(1);

            // The type can be: voucher, promo and item(barang).
            $table->string('type')->default('voucher'); //

            // Voucher or item (barang) category, choice : menarik, rekomendasi.
            $table->string('category')->nullable();

            $table->string('image')->nullable();

            // The amount to discount by (in pennies) in this example.
            $table->integer('discount_amount')->nullable();

            // The amount to discount by (in prcent.
            $table->string('discount_percent')->nullable()->default(0);

            // Whether or not the voucher is a percentage or a fixed price. 
            $table->enum('discount_type', ['fixed', 'percent'])->default('percent');
            
            // When the voucher begins
            $table->timestamp('starts_at')->nullable();

            $table->tinyInteger('is_active')->nullable()->default(1);

            // When the voucher ends
            $table->timestamp('expires_at')->nullable();

            // Point needed for get this voucher
            $table->integer('point_needed');

            // You know what this is...
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
        Schema::dropIfExists('vouchers');
    }
};

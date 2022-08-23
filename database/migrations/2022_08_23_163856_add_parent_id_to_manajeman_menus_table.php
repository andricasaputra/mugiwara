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
        Schema::table('manajeman_menus', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->after('id')->nullable();
            $table->unsignedBigInteger('child_id')->after('parent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manajeman_menus', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('child_id');
        });
    }
};

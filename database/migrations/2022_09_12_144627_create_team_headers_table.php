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
        Schema::create('team_headers', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('keterangan');
            $table->string('gambar');
            $table->string('alt');
            $table->string('jabatan');
            $table->string('gambar_sosmed');
            $table->string('url_sosmed');
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
        Schema::dropIfExists('team_headers');
    }
};

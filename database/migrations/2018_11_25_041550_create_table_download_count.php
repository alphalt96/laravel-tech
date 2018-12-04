<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDownloadCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_count', function (Blueprint $table) {
            $table->increments('like_count');
            $table->unsignedInteger('id_song');
            $table->unsignedInteger('total');
            $table->timestamps();
        });

        Schema::table('download_count', function(Blueprint $table) {
            $table->foreign('id_song')->references('id_song')->on('song')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_count');
    }
}

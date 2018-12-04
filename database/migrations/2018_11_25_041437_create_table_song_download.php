<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSongDownload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_download', function (Blueprint $table) {
            $table->increments('song_download_id');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_song');
            $table->timestamps();
        });

        Schema::table('song_download', function (Blueprint $table) {
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
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
        Schema::dropIfExists('song_download');
    }
}

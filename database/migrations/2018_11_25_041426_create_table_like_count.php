<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLikeCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_count', function (Blueprint $table) {
            $table->increments('like_count');
            $table->unsignedInteger('id_song');
            $table->unsignedInteger('total');
            $table->timestamps();
        });

        Schema::table('like_count', function(Blueprint $table) {
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
        Schema::dropIfExists('like_count');
    }
}

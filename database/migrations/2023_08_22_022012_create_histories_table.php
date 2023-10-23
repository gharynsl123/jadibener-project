<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_user')->unsigned();
            $table->integer('id_peralatan')->unsigned()->nullable();
            $table->integer('id_pengajuan')->unsigned()->nullable();
            $table->integer('id_progress')->unsigned()->nullable();
            $table->integer('id_estimasibiaya')->unsigned()->nullable();

            $table->string('tanggal');
            $table->string('status_history');
            $table->string('deskripsi')->nullable();
            
            $table->foreign('id_estimasibiaya')->references('id')->on('estimasibiaya')->onDelete('cascade');
            $table->foreign('id_progress')->references('id')->on('progress')->onDelete('cascade');
            $table->foreign('id_pengajuan')->references('id')->on('pengajuan')->onDelete('cascade');
            $table->foreign('id_peralatan')->references('id')->on('peralatan')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('histories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalteknisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwalteknisi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_peralatan')->unsigned();
            $table->integer('id_instansi')->unsigned();
            $table->integer('id_user')->unsigned();
            
            $table->string('jadawal');
            $table->string('keluhan');
            $table->string('renaca_tindakan');

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_peralatan')->references('id')->on('peralatan');
            $table->foreign('id_instansi')->references('id')->on('instansi');
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
        Schema::dropIfExists('jadwalteknisi');
    }
}

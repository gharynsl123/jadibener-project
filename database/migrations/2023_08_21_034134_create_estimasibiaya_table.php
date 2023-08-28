<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimasibiayaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimasibiaya', function (Blueprint $table) {
            $table->increments('id');
            $table->string('harga');
            $table->integer('id_instansi')->unsigned();
            $table->integer('id_peralatan')->unsigned();
            $table->integer('id_kategori')->unsigned();
            $table->integer('id_part')->unsigned();
            $table->foreign('id_instansi')->references('id')->on('instansi')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('id_peralatan')->references('id')->on('peralatan')->onDelete('cascade');
            $table->foreign('id_part')->references('id')->on('part')->onDelete('cascade');
            $table->string('keterangan');
            $table->string('quantity');
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
        Schema::dropIfExists('estimasibiaya');
    }
}

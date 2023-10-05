<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_peralatan')->unsigned();

            $table->string('judul_masalah');
            $table->string('deskripsi_masalah');
            $table->string('id_pengenal')->nullable();
            $table->enum('status_pengajuan', ['pending', 'approved', 'rejected', 'selesai'])->default('pending');
            $table->enum('kondisi', ['ctok', 'reguler', 'berkala', 'lain-lain'])->default('reguler');
            $table->string('slug');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_peralatan')->references('id')->on('peralatan')->onDelete('cascade');
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
        Schema::dropIfExists('pengajuan');
    }
}

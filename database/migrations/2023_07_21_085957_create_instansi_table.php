<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instasi');
            $table->string('alamat');
            $table->integer('id_user')->unsigned();
            $table->bigInteger('jumlah_kasur');
            $table->enum('status', ['pemerintah', 'suasta']);
            $table->string('kelas');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('instansi');
    }
}

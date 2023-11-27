<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instansi');
            $table->string('alamat_instansi');
            $table->string('nama_user');
            $table->string('email');
            $table->string('nomor_telepon');
            $table->string('password');
            $table->text('ajukan_permasalahan')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('departement', ['Hospital Kitchen', 'CSSD', 'Purchasing', 'IPS-RS']);
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
        Schema::dropIfExists('req_member');
    }
}

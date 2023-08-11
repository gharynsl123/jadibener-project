<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_instansi')->unsigned()->nullable()->default(null);

            $table->string('nama_user');
            $table->string('alamat_user')->nullable();
            $table->string('email')->unique();
            $table->string('nomor_telepon')->nullable()->default(null);
            $table->string('password');

            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable()->default(null);
            $table->enum('level', ['admin', 'pic', 'sub_service', 'surveyor', 'teknisi'])->default('admin');
            $table->enum('role', ['qizi', 'alkes', 'manager', 'cssd'])->nullable()->default(null);

            $table->foreign('id_instansi')->references('id')->on('instansi')->onDelete('cascade');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

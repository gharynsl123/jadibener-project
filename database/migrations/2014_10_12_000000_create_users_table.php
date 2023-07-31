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
            $table->string('name');
            $table->string('alamat')->nullable();
            $table->integer('id_instansi')->unsigned()->nullable()->default(null);
            $table->string('email')->unique();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable()->default(null);
            $table->enum('level', ['admin', 'pic_rs', 'sub_service', 'surveyor', 'teknisi'])->default('admin');
            $table->enum('role', ['qizi', 'alkes', 'manager', 'cssd'])->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreign('id_instansi')->references('id')->on('instansi')->onDelete('cascade');
            $table->string('no_telp')->nullable()->default(null);
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

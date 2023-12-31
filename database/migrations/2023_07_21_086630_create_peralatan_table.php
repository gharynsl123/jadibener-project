<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeralatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peralatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned()->nullable();
            $table->integer('id_instansi')->unsigned();
            $table->integer('id_merek')->unsigned();
            $table->integer('id_kategori')->unsigned();
            $table->integer('id_product')->unsigned();
            
            
            $table->enum('departement', ['Hospital Kitchen', 'CSSD'])->nullable()->default(null);
            $table->enum('produk_dalam_kondisi', ['baik', 'rusak', 'hilang'])->default('baik');
            $table->string('serial_number');
            $table->string('tahun_pemasangan');
            $table->string('slug');
            $table->string('usia_barang');
            $table->string('saran_perbaikan')->nullable();
            $table->string('kondisi_product')->default('100');
            
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_instansi')->references('id')->on('instansi')->onDelete('cascade');
            $table->foreign('id_merek')->references('id')->on('merek')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('produk')->onDelete('cascade');
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
        Schema::dropIfExists('peralatan');
    }
}

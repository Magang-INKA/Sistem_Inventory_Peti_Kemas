<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_barang', 50)->nullable();
            $table->string('nama_barang', 50)->nullable();
            $table->string('gambar',50)->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->unsignedBigInteger('id_container')->nullable();
            $table->foreign('id_container')->references('id')->on('container');
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
        Schema::dropIfExists('barang');
    }
}

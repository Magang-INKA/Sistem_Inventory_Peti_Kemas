<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBarang extends Migration
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
            $table->string('nama_barang', 50)->nullable();
            $table->integer('jumlah_barang');
            $table->string('requierement', 50)->nullable();
            $table->unsignedBigInteger('id_container');
            $table->foreign('id_container')->references('id')->on('container');
            $table->unsignedBigInteger('id_booking');
            $table->foreign('id_booking')->references('id')->on('booking');
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

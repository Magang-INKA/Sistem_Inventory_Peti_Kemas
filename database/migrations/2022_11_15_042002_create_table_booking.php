<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->char('no_resi',255);
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_jadwal')->unsigned();
            $table->foreign('id_jadwal')->references('id')->on('jadwal_kapal')->onDelete('cascade');
            $table->unsignedBigInteger('id_container')->nullable();
            $table->foreign('id_container')->references('id')->on('container');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('master_barang');
            $table->date('date');
            $table->string('status');
            $table->string('nama_penerima');
            $table->string('telp_penerima');
            $table->string('alamat_penerima');
            $table->string('catatan',255)->nullable();
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
        Schema::dropIfExists('booking');
    }
}

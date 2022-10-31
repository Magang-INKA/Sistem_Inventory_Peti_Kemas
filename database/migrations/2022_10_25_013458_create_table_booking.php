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
            $table->string('kode', 20)->unique();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('no_container');
            $table->foreign('no_container')->references('no_container')->on('master_container');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('master_barang');
            $table->string('no_kapal');
            $table->foreign('no_kapal')->references('no_kapal')->on('master_kapal');
            $table->unsignedBigInteger('id_pelabuhan');
            $table->foreign('id_pelabuhan')->references('id')->on('master_pelabuhan');
            $table->date('date');
            $table->string('status');
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

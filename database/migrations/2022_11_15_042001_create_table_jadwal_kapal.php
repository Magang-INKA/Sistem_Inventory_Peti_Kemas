<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJadwalKapal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_kapal', function (Blueprint $table) {
            $table->increments('id');
            $table->char('id_kapal',20);
            $table->integer('id_trip')->unsigned();
            $table->dateTime('ETA')->nullable();
            $table->dateTime('ETD')->nullable();
            $table->foreign('id_kapal')->references('no_kapal')->on('master_kapal')->onDelete('cascade');
            $table->foreign('id_trip')->references('id')->on('trip')->onDelete('cascade');
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
        Schema::dropIfExists('jadwal_kapal');
    }
}

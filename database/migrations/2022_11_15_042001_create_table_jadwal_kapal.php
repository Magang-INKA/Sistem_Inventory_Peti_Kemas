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
            $table->integer('id_trip')->unsigned();
            $table->char('asal_pelabuhan_id',10);
            $table->char('tujuan_pelabuhan_id',10);
            $table->datetime('ETA_awal');
            $table->datetime('ETD_awal');
            $table->datetime('ETA_tujuan');
            $table->timestamps();

            $table->foreign('id_trip')
            ->references('id')
            ->on('trip')
            ->onDelete('cascade');

            $table->foreign('asal_pelabuhan_id')
            ->references('kode_pelabuhan')
            ->on('master_pelabuhan')
            ->onDelete('cascade');

            $table->foreign('tujuan_pelabuhan_id')
            ->references('kode_pelabuhan')
            ->on('master_pelabuhan')
            ->onDelete('cascade');
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

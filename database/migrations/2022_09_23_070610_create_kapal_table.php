<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKapalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kapal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_keberangkatan');
            $table->foreign('id_keberangkatan')->references('id')->on('pelabuhan');
            $table->unsignedBigInteger('id_tujuan');
            $table->foreign('id_tujuan')->references('id')->on('pelabuhan');
            $table->string('nama_kapal');
            $table->string('keberangkatan');
            $table->string('tujuan');
            $table->date('jadwal');
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
        Schema::dropIfExists('kapal');
    }
}

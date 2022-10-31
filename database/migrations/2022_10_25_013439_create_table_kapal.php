<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKapal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kapal', function (Blueprint $table) {
            $table->id();
            $table->string('no_kapal', 20)->unique();
            $table->foreign('no_kapal')->references('no_kapal')->on('master_kapal');
            $table->unsignedBigInteger('id_keberangkatan');
            $table->foreign('id_keberangkatan')->references('id')->on('master_pelabuhan');
            $table->unsignedBigInteger('id_tujuan');
            $table->foreign('id_tujuan')->references('id')->on('master_pelabuhan');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kapal');
            $table->foreign('id_kapal')->references('id')->on('kapal');
            $table->string('nama_container', 50)->nullable();
            $table->unsignedBigInteger('id_pelabuhan');
            $table->foreign('id_pelabuhan')->references('id')->on('pelabuhan');
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
        Schema::dropIfExists('container');
    }
}

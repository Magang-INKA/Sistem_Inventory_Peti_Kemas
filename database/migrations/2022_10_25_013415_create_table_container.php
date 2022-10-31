<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableContainer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container', function (Blueprint $table) {
            $table->id();
            $table->string('no_container', 20);
            $table->foreign('no_container')->references('no_container')->on('master_container');
            $table->string('no_kapal', 20);
            $table->foreign('no_kapal')->references('no_kapal')->on('master_kapal');
            $table->unsignedBigInteger('id_pelabuhan');
            $table->foreign('id_pelabuhan')->references('id')->on('master_pelabuhan');
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

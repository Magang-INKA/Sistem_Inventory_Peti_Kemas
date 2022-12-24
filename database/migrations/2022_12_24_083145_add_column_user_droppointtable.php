<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserDroppointtable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drop_point', function (Blueprint $table) {
            // $table->addColumn('operator')->after('keterangan')->unsigned();
            $table->unsignedBigInteger('operator')->after('keterangan');
            $table->foreign('operator')->references('id')->on('users');
        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

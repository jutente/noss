<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IdsetorServidor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servidors', function (Blueprint $table) {
            //
            $table->unsignedinteger('idsetor');
            $table->foreign('idsetor')->references('idsetor')->on('setors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servidors', function (Blueprint $table) {
            //
            $table->dropForeign('servidors_idsetor_foreign');
            $table->dropColumn('idsetor');
        });
    }
}

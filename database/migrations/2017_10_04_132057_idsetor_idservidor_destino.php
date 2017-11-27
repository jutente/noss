<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IdsetorIdservidorDestino extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('destinos', function (Blueprint $table) {
            //
            //$table->unsignedinteger('idsetor');
            //$table->foreign('idsetor')->references('idsetor')->on('setors')->onDelete('cascade');

            $table->unsignedinteger('idservidor');
            $table->foreign('idservidor')->references('idservidor')->on('servidors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destinos', function (Blueprint $table) {
            //
            // $table->dropForeign('destinos_idsetor_foreign');
            // $table->dropColumn('idsetor');

            $table->dropForeign('destinos_idservidor_foreign');
            $table->dropColumn('idservidor');
        });
    }
}

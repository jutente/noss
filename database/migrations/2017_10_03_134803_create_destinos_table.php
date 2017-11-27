<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinos', function (Blueprint $table) {
            $table->increments('iddestino');
            $table->string('setor',200);
            //$table->unsignedinteger('idsetor');
            //$table->foreign('idsetor','fk_destinos_setors')->references('idsetor')->on('setors')->onUpdate('cascade')->index();
            //$table->unsignedinteger('idservidor');
            //$table->foreign('idservidor','fk_destinos_servidors')->references('idservidor')->on('servidors')->onUpdate('cascade')->index();            
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('destinos');
        Schema::enableForeignKeyConstraints();
    }
}

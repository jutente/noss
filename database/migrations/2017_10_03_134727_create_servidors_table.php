<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servidors', function (Blueprint $table) {
            $table->increments('idservidor');
            $table->string('servidor',100);
            $table->string('matricula',6);
            $table->string('tel',13);
            $table->integer('protocolo')->unique();
            $table->date('dtprotocolo');
            $table->string('obs',254)->nullable();
            //$table->unsignedinteger('idcargo');
           // $table->foreign('idcargo','fk_cargos_servidors')->references('idcargo')->on('cargos')->onUpdate('cascade')->index();
            //$table->unsignedinteger('idsetor'); 
           // $table->foreign('idsetor','fk_servidors_setors')->references('idsetor')->on('setors')->onUpdate('cascade')->index();
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
        Schema::dropIfExists('servidors');
        Schema::enableForeignKeyConstraints();
    }
}

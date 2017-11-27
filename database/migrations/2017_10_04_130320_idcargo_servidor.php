<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IdcargoServidor extends Migration
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
            $table->unsignedinteger('idcargo');
            $table->foreign('idcargo')->references('idcargo')->on('cargos')->onDelete('cascade');
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
            $table->dropForeign('servidors_idcargo_foreign');
            $table->dropColumn('idcargo');
        });
    }
}

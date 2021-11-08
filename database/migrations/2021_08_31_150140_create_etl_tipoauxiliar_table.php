<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtlTipoauxiliarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dba.ETL_TIPOAUXILIAR', function (Blueprint $table) {
            $table->id("ID");
            $table->primary("ID");
            $table->string("nombre");
            $table->string("nombre_corto");
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
        Schema::dropIfExists('dba.ETL_TIPOAUXILIAR');
    }
}

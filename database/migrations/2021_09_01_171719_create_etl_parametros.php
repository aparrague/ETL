<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtlParametros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dba.ETL_PARAMETROS', function (Blueprint $table) {
            $table->id("ID");
            $table->primary("ID");
            $table->bigInteger("IDTIPODOCUMENTO");
            $table->bigInteger("IDCUENTA");
            $table->integer("NUEVO");
            $table->integer("ANTIGUO");
            $table->integer("COD_CARRERA");
            $table->timestamps();
            $table->foreign("IDTIPODOCUMENTO")->references("id")->on("dba.ETL_TIPODOCUMENTO");
            $table->foreign("IDCUENTA")->references("id")->on("dba.ETL_CUENTAS");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dba.ETL_PARAMETROS');
    }
}

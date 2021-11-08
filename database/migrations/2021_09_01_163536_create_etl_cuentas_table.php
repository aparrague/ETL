<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtlCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dba.ETL_CUENTAS', function (Blueprint $table) {
            $table->id("ID");
            $table->primary("ID");
            $table->bigInteger("IDAUXILIAR");
            // $table->foreignId("IDAUXILIAR")->references("id")->on("dba.ETL_TIPOAUXILIAR");
            $table->string("CUENTA", 20);
            $table->string("DESCRIPCION", 100);
            $table->integer("DETALLEGASTO");
            $table->integer("CCOSTO");
            $table->integer("DOCUMENTO");
            $table->timestamps();
            $table->foreign("IDAUXILIAR")->references("id")->on("dba.ETL_TIPOAUXILIAR");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dba.ETL_CUENTAS');
    }
}

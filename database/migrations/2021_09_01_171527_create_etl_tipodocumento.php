<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtlTipodocumento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dba.ETL_TIPODOCUMENTO', function (Blueprint $table) {
            $table->id("ID");
            $table->primary("ID");
            $table->string("TTD_SPV", 5);
            $table->string("TTD_SOFTLAND", 3);
            $table->string("DESCRIPCION");
            $table->integer("LIBRO");
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
        Schema::dropIfExists('dba.ETL_TIPODOCUMENTO');
    }
}

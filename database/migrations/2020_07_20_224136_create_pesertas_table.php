<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('noreg')->unique();
            $table->string('nama');
            $table->unsignedBigInteger('konsentrasi_id');
            $table->timestamps();

            $table->foreign('konsentrasi_id')->references('id')->on('konsentrasis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesertas');
    }
}

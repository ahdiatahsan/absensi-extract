<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('peserta_id');
            $table->unsignedBigInteger('agenda_id');
            $table->dateTime('jam_datang');
            $table->dateTime('jam_pulang');
            $table->string('status');
            $table->timestamps();

            $table->foreign('peserta_id')->references('id')->on('pesertas');
            $table->foreign('agenda_id')->references('id')->on('agendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}

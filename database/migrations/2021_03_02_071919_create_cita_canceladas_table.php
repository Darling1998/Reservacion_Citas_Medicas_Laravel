<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitaCanceladasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita_canceladas', function (Blueprint $table) {
            $table->id();

            $table->string('justificacion')->nullable();

            $table->unsignedBigInteger('cita_id');
            $table->foreign('cita_id')->references('id')->on('citas');

            $table->unsignedBigInteger('cancelado_por_id');
            $table->foreign('cancelado_por_id')->references('id')->on('users');
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
        Schema::dropIfExists('cita_canceladas');
    }
}

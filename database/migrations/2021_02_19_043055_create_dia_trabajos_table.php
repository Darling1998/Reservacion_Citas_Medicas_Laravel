<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_trabajos', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('dia');
            $table->boolean('activo');
            $table->time('hora_inicio_mñn');
            $table->time('hora_fin_mñn');
            $table->time('hora_inicio_tarde');
            $table->time('hora_fin_tarde');

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('dia_trabajos');
    }
}

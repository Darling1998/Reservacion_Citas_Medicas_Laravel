<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
           
            //fecha y hora de cita programada
            $table->date('fecha_cita');
            $table->time('hora_cita');

             //medico
            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')->references('id')->on('users');

            //usuario
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('users');
         

            $table->unsignedBigInteger('especialidad_id');
            $table->foreign('especialidad_id')->references('id')->on('especialidads')->onDelete('cascade');

            //Reservada,cancelada,confirmada,atendida,cancelada
            $table->string('estado')->default('Reservada');

            $table->string('tipo');
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
        Schema::dropIfExists('citas');
    }
}

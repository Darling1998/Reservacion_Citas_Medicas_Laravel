<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $medicosIds= User::medicos()->pluck('id');
        $pacientes= User::pacientes()->pluck('id');

        $fecha=$this->faker->dateTimeBetween('-1 years','now');
        $fecha_cita= $fecha->format('Y-m-d');
        $hora_cita= $fecha->format('H:i:s');

        $estados=['Atendida','Cancelada'];
        $tipos=['Consulta','Exámen','Operación'];
        
        return [
            'descripcion'=>$this->faker->sentence(5),
            'especialidad_id'=>$this->faker->numberBetween(1,3),
            'medico_id'=>$this->faker->randomElement($medicosIds),
            'fecha_cita'=>$fecha_cita,
            'hora_cita'=>$hora_cita,
            'paciente_id'=>$this->faker->randomElement($pacientes),
            'tipo'=>$this->faker->randomElement($tipos),
            'estado'=>$this->faker->randomElement($estados),
        ];
    }
}

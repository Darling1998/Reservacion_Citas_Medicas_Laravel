<?php

namespace Database\Seeders;
use App\Models\User;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades=[
            'Genética',
            'Obstetricia',
            'Pediatría',
        ];

        foreach($especialidades as $item){
           
           $especialidad= Especialidad::create([
                'nombre'=>$item
            ]);

            
            $especialidad->usuarios()->saveMany(
                User::factory(3)->medicop()->make()
            );
        }

    }
}

<?php

namespace Database\Seeders;

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
            Especialidad::create([
                'nombre'=>$item
            ]);
        }

    }
}

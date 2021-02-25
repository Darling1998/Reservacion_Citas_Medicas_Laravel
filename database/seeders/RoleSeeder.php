<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new Role();
        $rol->nombre='admin';
        $rol->save();

        $rol_1 = new Role();
        $rol_1->nombre='medico';
        $rol_1->save();

        $rol_2 = new Role();
        $rol_2->nombre='paciente';
        $rol_2->save();
    }
}

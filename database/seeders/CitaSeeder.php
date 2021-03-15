<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cita;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cita::factory(100)->create();
    }
}

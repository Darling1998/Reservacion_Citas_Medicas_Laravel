<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Darling',
            'email' => 'delacruzdarjo@hotmail.com',
            'password' => bcrypt('darling123'),
            'apellido'=>'De La Cruz',
            'cedula'=>'1234567890',
            'direccion'=>'Salinas',
            'telefono'=>'0986653745',
            'role_id'=>'1',
        ]);
        $this->call(RoleSeeder::class);
    }
}

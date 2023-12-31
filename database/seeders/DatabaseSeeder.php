<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cuestionario;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // $this->call(ExcelSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(CursosSeeder::class);
        $this->call(EstudianteSeeder::class);
        $this->call(ConsejeroSeeder::class);
        $this->call(DirectorSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CuestionarioSeeder::class);
        $this->call(PreguntaSeeder::class);
    }
}

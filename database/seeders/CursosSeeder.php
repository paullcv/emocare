<?php

namespace Database\Seeders;
use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::create(['nombre' => 'Curso 1ro']);
        Curso::create(['nombre' => 'Curso 2do']);
        Curso::create(['nombre' => 'Curso 3ro']);
    }
}

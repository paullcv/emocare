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
        Curso::create(['nombre' => 'Curso 1ro A']);
        Curso::create(['nombre' => 'Curso 1ro B']);
        Curso::create(['nombre' => 'Curso 1ro C']);
        Curso::create(['nombre' => 'Curso 2do A']);
        Curso::create(['nombre' => 'Curso 2do B']);
        Curso::create(['nombre' => 'Curso 2do C']);
        Curso::create(['nombre' => 'Curso 3ro A']);
        Curso::create(['nombre' => 'Curso 3ro B']);
        Curso::create(['nombre' => 'Curso 4to A']);
        Curso::create(['nombre' => 'Curso 4to B']);
        Curso::create(['nombre' => 'Curso 5to A']);
        Curso::create(['nombre' => 'Curso 5to B']);
        Curso::create(['nombre' => 'Curso 6to A']);
        Curso::create(['nombre' => 'Curso 6to B']);
    }
}

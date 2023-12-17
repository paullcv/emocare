<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Faker\Factory as FakerFactory;


class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los cursos disponibles
        $cursos = Curso::all();

        // Definir la cantidad de estudiantes que deseas crear por cada curso
        $estudiantesPorCurso = 30;

        // Crear una instancia de Faker
        $faker = FakerFactory::create();

        foreach ($cursos as $curso) {
            // Crear la cantidad específica de estudiantes para cada curso
            for ($i = 0; $i < $estudiantesPorCurso; $i++) {
                $this->createEstudiante(
                    $faker->unique()->safeEmail,
                    $faker->name,
                    $faker->randomElement(['masculino', 'femenino']),
                    "Observación para Estudiante {$curso->id}_{$i}",
                    $curso
                );
            }
        }
    }

    private function createEstudiante($email, $name, $sexo, $observacion, $curso)
    {
        $existingUser = User::where('email', $email)->first();
    
        if ($existingUser) {
            return $existingUser->userable;
        }
    
        $edad = mt_rand(12, 18); // Generar edad aleatoria entre 12 y 18 años
    
        $user = User::create([
            'email' => strtolower($email),
            'name' => $name,
            'password' => bcrypt('password'), // Cambiar a una contraseña segura
            'sexo' => $sexo, // Agregar el género directamente al usuario
            'edad' => $edad, // Agregar la edad directamente al usuario
        ]);
    
        $estudiante = Estudiante::create([
            'observacion' => $observacion,
            'user_id' => $user->id,
            'curso_id' => $curso->id,
        ]);
    
        $estudianteRole = Role::where('name', 'estudiante')->first();
        $user->assignRole($estudianteRole);
    
        $user->userable()->associate($estudiante);
        $user->save();
    
        return $estudiante;
    }
    
}

<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los cursos disponibles
        $cursos = Curso::all();

        // Definir la cantidad de estudiantes que deseas crear
        $cantidadEstudiantes = 100;

        // Crear estudiantes en cada curso
        foreach ($cursos as $curso) {
            for ($i = 0; $i < $cantidadEstudiantes; $i++) {
                $this->createEstudiante(
                    "estudiante{$i}@example.com",
                    "Estudiante {$i}",
                    "Observación para Estudiante {$i}",
                    $curso
                );
            }
        }
    }

    private function createEstudiante($email, $name, $observacion, $curso)
    {
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            return $existingUser->userable;
        }

        $user = User::create([
            'email' => strtolower($email),
            'name' => $name,
            'password' => bcrypt('password'), // Usa bcrypt para encriptar la contraseña
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

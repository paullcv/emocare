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
        $cursoA = Curso::where('nombre', 'Curso 1ro')->first();

        // Crear estudiante en Curso A
        $estudianteA = $this->createEstudiante('estudianteA@example.com', 'Estudiante A', 'Estudiante Observacion A', $cursoA);

        $cursoB = Curso::where('nombre', 'Curso 2do')->first();

        // Crear estudiante en Curso B
        $estudianteB = $this->createEstudiante('estudianteB@example.com', 'Estudiante B', 'Estudiante Observacion B', $cursoB);
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
            'password' => Hash::make('password'), // Usar Hash::make para encriptar la contraseña
        ]);

        $estudiante = Estudiante::create([
            'observacion' => $observacion,
            'user_id' => $user->id,
            'curso_id' => $curso->id,
        ]);

        // Asignar el rol 'estudiante' al usuario
        $estudianteRole = Role::where('name', 'estudiante')->first();
        $user->assignRole($estudianteRole);

        $user->userable()->associate($estudiante);
        $user->save();

        return $estudiante;
    }
}

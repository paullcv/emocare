<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Director;
use App\Models\Consejero;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear usuario Paul
        $this->createUser('paul@gmail.com', 'Paul', 'password');

        // Crear usuario Karla
        $this->createUser('karla@gmail.com', 'Karla', 'password');
    }

    private function createUser($email, $name, $password)
    {
        $existingUser = User::where('email', $email)->first();

        if (!$existingUser) {
            User::create([
                'email' => strtolower($email),
                'name' => $name,
                'password' => Hash::make($password),
            ]);
        }
    }
}

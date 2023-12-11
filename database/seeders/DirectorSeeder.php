<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $director = $this->createDirector('director@gamil.com', 'Director User', 'Director');
        $director = $this->createDirector('paulcruz@gmail.com', 'Director Paul', 'Director');

    }

    private function createDirector($email, $name, $cargo)
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

        $director = Director::create([
            'cargo' => $cargo,
            'user_id' => $user->id,
        ]);

          // Asignar el rol 'director' al usuario
          $directorRole = Role::where('name', 'director')->first();
          $user->assignRole($directorRole);
          
        $user->userable()->associate($director);
        $user->save();

        return $director;
    }
}

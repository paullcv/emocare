<?php

namespace Database\Seeders;

use App\Models\Consejero;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ConsejeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consejero = $this->createConsejero('consejero@example.com', 'Consejero User', 'Consejero Especialidad');
    }

    private function createConsejero($email, $name, $especialidad)
    {
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            return $existingUser->userable;
        }

        $user = User::create([
            'email' => strtolower($email),
            'name' => $name,
            'password' => Hash::make('password'),
        ]);

        $consejero = Consejero::create([
            'especialidad' => $especialidad,
            'user_id' => $user->id,
        ]);

            // Asignar el rol 'director' al usuario
            $consejeroRole = Role::where('name', 'consejero')->first();
            $user->assignRole($consejeroRole);
            
        $user->userable()->associate($consejero);
        $user->save();

        return $consejero;
    }
}

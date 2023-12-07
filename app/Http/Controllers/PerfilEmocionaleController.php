<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PerfilEmocionaleController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios con el rol "estudiante"
        $estudiantes = User::whereHas('roles', function ($query) {
            $query->where('name', 'estudiante');
        })->get();

        // Pasar los estudiantes a la vista
        return view('perfilemocional.index', compact('estudiantes'));
    }

    public function ver(User $estudiante)
    {
        $respuestas = $estudiante->respuestas; // Asumiendo que tienes una relación llamada 'respuestas' en tu modelo User

        return view('perfilemocional.ver', compact('estudiante', 'respuestas'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PerfilEmocionaleController extends Controller
{
    public function index()
    {
        $estudiantes = User::whereHas('roles', function ($query) {
            $query->where('name', 'estudiante');
        })->with('userable.curso')->paginate(25); // Cambia 10 por la cantidad de registros por página que desees

        return view('perfilemocional.index', compact('estudiantes'));
    }


    public function ver(User $estudiante)
    {
        $respuestas = $estudiante->respuestas; // Asumiendo que tienes una relación llamada 'respuestas' en tu modelo User

        return view('perfilemocional.ver', compact('estudiante', 'respuestas'));
    }
}

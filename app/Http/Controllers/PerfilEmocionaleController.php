<?php

namespace App\Http\Controllers;

use App\Models\PerfilEmocionale;
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
        // Obtener el perfil emocional del estudiante autenticado
        $perfilEmocional = PerfilEmocionale::where('estudiante_id', $estudiante->userable->id)->first();
    
        // Obtener la sumatoria de respuestas para cada categoría
        $totalPositivo = PerfilEmocionale::where('estudiante_id', $estudiante->userable->id)->sum('resume_positivo');
        $totalNegativo = PerfilEmocionale::where('estudiante_id', $estudiante->userable->id)->sum('resume_negativo');
        $totalNeutral = PerfilEmocionale::where('estudiante_id', $estudiante->userable->id)->sum('resume_neutral');
    
        $respuestas = $estudiante->respuestas;
    
        return view('perfilemocional.ver', compact('estudiante', 'respuestas', 'totalPositivo', 'totalNegativo', 'totalNeutral'));
    }
    
}

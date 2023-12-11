<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\SesionApoyo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesionApoyoController extends Controller
{
    public function index()
    {
        $sesiones = SesionApoyo::all();
        return view('sesionesApoyo.index', compact('sesiones'));
    }

    public function create()
    {
        $estudiantes = Estudiante::with('user')->get();
        $cursos = Curso::all();
        return view('sesionesApoyo.create', compact('estudiantes', 'cursos'));
    }



    public function sendData(Request $request)
    {
        $request->validate([
            'motivo' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'estudiante_id' => 'required|exists:estudiante,id',
            'observacion' => 'nullable|string',
            'recomendacion' => 'nullable|string',
        ]);

        SesionApoyo::create($request->all());

        return redirect()->route('sesiones.index')->with('notificacion', 'La sesión de apoyo se creó correctamente.');
    }


    public function edit(SesionApoyo $sesion)
    {
        $estudiantes = Estudiante::with('user')->get();
        $cursos = Curso::all();
        return view('sesionesApoyo.edit', compact('sesion', 'estudiantes', 'cursos'));
    }

    public function update(Request $request, SesionApoyo $sesion)
    {
        $request->validate([
            'motivo' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'estudiante_id' => 'required|exists:estudiante,id',
            'observacion' => 'nullable|string', // Campo observación agregado
            'recomendacion' => 'nullable|string', // Campo recomendación agregado
        ]);

        $sesion->update($request->all());

        return redirect()->route('sesiones.index')->with('notificacion', 'La sesión de apoyo se actualizó correctamente.');
    }


    public function destroy(SesionApoyo $sesion)
    {
        $sesion->delete();

        return redirect()->route('sesiones.index')->with('notificacion', 'La sesión de apoyo se eliminó correctamente.');
    }

    public function misSesiones()
    {
        // Obtener el estudiante actual autenticado
        $estudiante = Auth::user()->userable;

        // Obtener las sesiones de apoyo del estudiante
        $sesiones = $estudiante->sesionesApoyo;
        return view('sesionesApoyo.missesiones', compact('sesiones'));
    }

    public function misRecomendaciones(SesionApoyo $sesionapoyo)
    {
        // Aquí puedes realizar lógica para obtener la recomendación asociada a la sesión de apoyo
        $recomendacion = $sesionapoyo->recomendacion;

        // Puedes pasar la recomendación a la vista
        return view('sesionesApoyo.misrecomendaciones', compact('recomendacion', 'sesionapoyo'));
    }
}

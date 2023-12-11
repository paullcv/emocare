<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\SesionApoyo;
use App\Models\User;
use Illuminate\Http\Request;

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
        ]);

        SesionApoyo::create($request->all());

        return redirect()->route('sesiones.index')->with('notificacion', 'La sesión de apoyo se creó correctamente.');
    }

    public function edit(SesionApoyo $sesion)
    {
        $estudiantes = Estudiante::all();
        return view('sesionesApoyo.edit', compact('sesion', 'estudiantes'));
    }

    public function update(Request $request, SesionApoyo $sesion)
    {
        $request->validate([
            'motivo' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'estudiante_id' => 'required|exists:estudiantes,id',
        ]);

        $sesion->update($request->all());

        return redirect()->route('sesiones.index')->with('notificacion', 'La sesión de apoyo se actualizó correctamente.');
    }

    public function destroy(SesionApoyo $sesion)
    {
        $sesion->delete();

        return redirect()->route('sesiones.index')->with('notificacion', 'La sesión de apoyo se eliminó correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cuestionario;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function index()
    {
        $preguntas = Pregunta::all();
        return view('preguntas.index', compact('preguntas'));
    }

    public function create()
    {
        $cuestionarios = Cuestionario::all();
        return view('preguntas.create', compact('cuestionarios'));
    }

    public function sendData(Request $request)
    {
        $request->validate([
            'pregunta' => 'required',
            'cuestionario_id' => 'required|exists:cuestionarios,id',
        ]);

        Pregunta::create($request->all());

        return redirect()->route('preguntas.index')->with('notificacion', 'La pregunta se creó correctamente.');
    }

    public function edit(Pregunta $pregunta)
    {
        $cuestionarios = Cuestionario::all();
        return view('preguntas.edit', compact('pregunta', 'cuestionarios'));
    }

    public function update(Request $request, Pregunta $pregunta)
    {
        $request->validate([
            'pregunta' => 'required',
            'cuestionario_id' => 'required|exists:cuestionarios,id',
        ]);

        $pregunta->update($request->all());

        return redirect()->route('preguntas.index')->with('notificacion', 'La pregunta se actualizó correctamente.');
    }

    public function destroy(Pregunta $pregunta)
    {
        $pregunta->delete();

        return redirect()->route('preguntas.index')->with('notificacion', 'La pregunta se eliminó correctamente.');
    }
}

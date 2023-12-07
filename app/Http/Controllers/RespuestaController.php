<?php

namespace App\Http\Controllers;

use App\Models\Cuestionario;
use App\Models\Respuesta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    public function index()
    {
        // Obtener los cuestionarios asignados al estudiante
        $estudiante = auth()->user(); // Asumiendo que el estudiante está autenticado
        $cuestionarios = $estudiante->cuestionarios;

        return view('respuestas.index', compact('cuestionarios'));
    }


    public function responder(Cuestionario $cuestionario)
    {
        $preguntas = $cuestionario->preguntas;
        //dd($preguntas); // Añade esta línea para verificar las preguntas

        return view('respuestas.responder', compact('cuestionario', 'preguntas'));
    }

    public function guardarRespuestas(Request $request, Cuestionario $cuestionario)
    {
        // Validación de respuestas (puedes personalizar esto según tus necesidades)
        $rules = [];
        foreach ($cuestionario->preguntas as $pregunta) {
            $rules["respuestas.{$pregunta->id}"] = 'required|string|max:255';
        }

        $messages = [];
        foreach ($cuestionario->preguntas as $pregunta) {
            $messages["respuestas.{$pregunta->id}.required"] = "La respuesta a la pregunta '{$pregunta->pregunta}' es obligatoria.";
            $messages["respuestas.{$pregunta->id}.max"] = "La respuesta a la pregunta '{$pregunta->pregunta}' no puede tener más de :max caracteres.";
        }

        $this->validate($request, $rules, $messages);

        // Guardar las respuestas
        foreach ($cuestionario->preguntas as $pregunta) {
            $respuesta = new Respuesta([
                'respuesta' => $request->input("respuestas.{$pregunta->id}"),
                'pregunta_id' => $pregunta->id,
                'estudiante_id' => auth()->user()->id, // o donde obtengas el ID del estudiante
            ]);
            $respuesta->save();
        }

        // Puedes agregar un mensaje de éxito si lo deseas
        $notificacion = 'Respuestas enviadas correctamente.';

        // Redireccionar a la página que prefieras
        return redirect()->route('responder.index')->with(compact('notificacion'));
    }
}

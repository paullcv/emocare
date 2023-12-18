<?php

namespace App\Http\Controllers;

use App\Mail\alertas;
use App\Models\Cuestionario;
use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Guardar las respuestas con análisis de sentimientos
        $respuestasNegativas = 0;

        // Guardar las respuestas con análisis de sentimientos
        foreach ($cuestionario->preguntas as $pregunta) {
            $respuesta = new Respuesta([
                'respuesta' => $request->input("respuestas.{$pregunta->id}"),
                'pregunta_id' => $pregunta->id,
                'estudiante_id' => auth()->user()->id, // o donde obtengas el ID del estudiante
            ]);

            // Analizar sentimientos y asignar el resultado al atributo 'sentimiento'
            $sentimiento = $this->analizarSentimientos($respuesta->respuesta);
            $respuesta->sentimiento = $sentimiento;

            // Contar respuestas negativas
            if ($sentimiento === 'negativo') {
                $respuestasNegativas++;
            }

            $respuesta->save();
        }

        // Calcular el porcentaje de respuestas negativas
        $porcentajeNegativas = ($respuestasNegativas / count($cuestionario->preguntas)) * 100;

        // Enviar alerta si el porcentaje de respuestas negativas es mayor o igual al 60%
        if ($porcentajeNegativas >= 60) {
            $this->enviarAlertaRespuestasNegativas(
                auth()->user()->name,  // Nombre del estudiante
                $cuestionario->titulo, // Título del cuestionario
                $porcentajeNegativas   // Porcentaje de respuestas negativas
            );
        }


        // Puedes agregar un mensaje de éxito si lo deseas
        $notificacion = 'Respuestas enviadas correctamente.';

        // Redireccionar a la página que prefieras
        return redirect()->route('responder.index')->with(compact('notificacion'));
    }


    // Función para analizar sentimientos
    private function analizarSentimientos($texto)
    {
        // Aquí llamamos a tu función analizarSentimientos() y devolvemos el resultado
        // Asegúrate de que la función devuelva "positivo", "negativo" o "neutral" según tus necesidades.
        return $this->llamarAnalisisSentimientos($texto);
    }

    // Función para llamar al análisis de sentimientos
    private function llamarAnalisisSentimientos($texto)
    {
        // Aquí llamas a tu función analizarSentimientos() desde el controlador IA
        // Ajusta según tu estructura y requisitos específicos.
        // El código exacto dependerá de cómo hayas implementado tu análisis de sentimientos.

        $rutamodelo = public_path('bert_classifier.tflite');
        $scriptPath = base_path('IASentimientos/analisisSM.py');
        $venvPath = base_path('IASentimientos/venv');

        $command = "\"$venvPath/Scripts/activate\" && \"$venvPath/Scripts/python\" \"$scriptPath\" \"$rutamodelo\" \"$texto\"";
        $output = shell_exec($command);

        // Transformar el resultado según tus necesidades
        return $this->transformarSentimiento($output);
    }

    // Función para transformar el resultado del análisis de sentimientos
    private function transformarSentimiento($resultado)
    {
        // Lógica para transformar el resultado en "positivo", "negativo" o "neutral"
        // Ajusta según lo que realmente devuelve tu análisis de sentimientos.

        // Ejemplo básico (ajusta según tu implementación real):
        if (strpos($resultado, 'positive') !== false) {
            return 'positivo';
        } elseif (strpos($resultado, 'negative') !== false) {
            return 'negativo';
        } else {
            return 'neutral';
        }
    }

    private function enviarAlertaRespuestasNegativas($nombreEstudiante, $tituloCuestionario, $porcentajeNegativas)
    {
        // Aquí puedes enviar una alerta por correo electrónico
        $mensaje = "El estudiante $nombreEstudiante ha alcanzado un porcentaje de respuestas negativas del $porcentajeNegativas% en el cuestionario '$tituloCuestionario'. Revisar las respuestas.";
    
        // Pasar los argumentos correctos al constructor de la clase Alertas
        $mail = new Alertas($nombreEstudiante, $tituloCuestionario, $porcentajeNegativas);
    
        // Utilizar la variable $mail en lugar de la clase directamente
        Mail::to('paul.cruz.4.pc@gmail.com')->send($mail);
    }
    
}

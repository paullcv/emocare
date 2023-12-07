<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IAController extends Controller
{
    public function analizarSentimientos()
    {
        $rutamodelo = public_path('bert_classifier.tflite');
        $scriptPath = base_path('IASentimientos/analisisSM.py');
        $venvPath = base_path('IASentimientos/venv');

        //$texto = "Huy fue un buen dia pude avanzar en mi documentacion y estoy terminando de programar";
        $texto = "Hoy fue un mal dia no pude avanzar en mi documentacion y estoy terminando de programar";

        $command = "\"$venvPath/Scripts/activate\" && \"$venvPath/Scripts/python\" \"$scriptPath\" \"$rutamodelo\" \"$texto\"";

        // Ejecutar el script y obtener la salida
        $output = shell_exec($command);

        // Transformar la respuesta o manejar el error
        $sentimientoTransformado = $this->transformarSentimiento($output);

        // Devolver el resultado transformado
        return $sentimientoTransformado;
    }

    private function transformarSentimiento($sentimiento)
    {
        // Manejar el caso de error devolviendo "neutral"
        if ($sentimiento === null || $sentimiento === false) {
            return 'neutral';
        }

        // Convertir "positive" a "positivo" y "negative" a "negativo"
        return $sentimiento === 'positive' ? 'positivo' : ($sentimiento === 'negative' ? 'negativo' : $sentimiento);
    }
}

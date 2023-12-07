<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IAController extends Controller
{
    public function analizarSentimientos()
    {
        $rutamodelo= public_path('bert_classifier.tflite');
        $scriptPath = base_path('IASentimientos/analisisSM.py');
        $venvPath = base_path('IASentimientos/venv');

        $texto = "Huy fue unm buen dia pude avanzar en mi documentacion y estoy terminando de programar";
        
       // $command = "\"$venvPath/Scripts/activate\" && \"$venvPath/Scripts/python\" \"$scriptPath\"";
        $command = "\"$venvPath/Scripts/activate\" && \"$venvPath/Scripts/python\" \"$scriptPath\" \"$rutamodelo\" \"$texto\"";
        
        $output = shell_exec($command);
        
       // if ($output) {
         //   return response()->json(['message' => $output]);
        //} else {
         //   return response()->json(['error' => 'Error al ejecutar el script']);
        //}
        return $output;
    }
}

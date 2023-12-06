<?php

namespace App\Http\Controllers;

use App\Models\Cuestionario;
use Illuminate\Http\Request;

class CuestionarioController extends Controller
{
     // Mostrar todos los cuestionarios
     public function index()
     {
         $cuestionarios = Cuestionario::all();
         return view('cuestionarios.index', compact('cuestionarios'));
     }
 
     // Ir al formulario de creación
     public function create()
     {
         return view('cuestionarios.create');
     }
 
     // Crear el cuestionario en la base de datos
     public function sendData(Request $request)
     {
         $rules = [
             'titulo' => 'required|max:255',
             'descripcion' => 'nullable',
         ];
 
         $messages = [
             'titulo.required' => 'El título del cuestionario es obligatorio.',
         ];
 
         $this->validate($request, $rules, $messages);
 
         $cuestionario = new Cuestionario();
         $cuestionario->titulo = $request->input('titulo');
         $cuestionario->descripcion = $request->input('descripcion');
         $cuestionario->save();
 
         $notificacion = 'El cuestionario se creó correctamente.';
 
         return redirect('/cuestionarios')->with(compact('notificacion'));
     }
 
     // Ir a la vista de edición
     public function edit(Cuestionario $cuestionario)
     {
         return view('cuestionarios.edit', compact('cuestionario'));
     }
 
     // Editar un cuestionario
     public function update(Request $request, Cuestionario $cuestionario)
     {
         $rules = [
             'titulo' => 'required|max:255',
             'descripcion' => 'nullable',
         ];
 
         $messages = [
             'titulo.required' => 'El título del cuestionario es obligatorio.',
         ];
 
         $this->validate($request, $rules, $messages);
 
         $cuestionario->titulo = $request->input('titulo');
         $cuestionario->descripcion = $request->input('descripcion');
         $cuestionario->save();
 
         $notificacion = 'El cuestionario se actualizó correctamente.';
 
         return redirect('/cuestionarios')->with(compact('notificacion'));
     }
 
     // Eliminar cuestionario
     public function destroy(Cuestionario $cuestionario)
     {
         $tituloEliminar = $cuestionario->titulo;
         $cuestionario->delete();
 
         $notificacion = 'El cuestionario "' . $tituloEliminar . '" se eliminó correctamente.';
         return redirect('/cuestionarios')->with(compact('notificacion'));
     }
}

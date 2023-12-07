<?php

namespace App\Http\Controllers;

use App\Mail\notificaciones;
use App\Models\Cuestionario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


    // Nuevo método para asociar cuestionario con estudiantes
    public function enviar(Cuestionario $cuestionario)
    {
        // Obtener todos los estudiantes
        $estudiantes = User::whereHas('roles', function ($query) {
            $query->where('name', 'estudiante');
        })->get();

        // Asociar el cuestionario con cada estudiante
        $cuestionario->estudiantes()->sync($estudiantes);

        // Enviar notificación por correo electrónico a cada estudiante

       //foreach ($estudiantes as $estudiante) {
            Mail::to('paul.cruz.4.pc@gmail.com')->send(new notificaciones($cuestionario));
            //Mail::to($estudiante->email)->send(new notificaciones($cuestionario));
        //}


        // Mensaje de notificación
        $notificacion = 'Cuestionario enviado a todos los estudiantes correctamente.';

        // Flash del mensaje en la sesión
        session()->flash('notificacion', $notificacion);

        // Redirigir a la vista anterior
        return redirect()->back();
    }
}

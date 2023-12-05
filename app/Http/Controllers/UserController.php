<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use App\Models\Curso;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        // return view('users.index', compact('users'));

          // Obtener listas de usuarios por tipo
          $directores = User::where('userable_type', 'App\Models\Director')->get();
          $consejeros = User::where('userable_type', 'App\Models\Consejero')->get();
          $estudiantes = User::where('userable_type', 'App\Models\Estudiante')->get();
  
          return view('users.index', compact('directores', 'consejeros', 'estudiantes'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return ".store";
        // Lógica para almacenar un nuevo usuario
        // Validación de datos
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'tipo' => 'required|integer',
            'password' => 'required|min:8',
        ]);

        // Crear un nuevo usuario
        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->tipo = $request->input('tipo');
        $user->password = bcrypt($request->input('password'));
        // ... otros atributos según sea necesario ...

        // Guardar el nuevo usuario
        $user->save();

        // Redirigir a la vista del usuario creado
        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $user = User::findOrFail($id);


        // return view('users.edit', compact('user'));

        $roles = Role::all();
        $cursos = Curso::all();
        $user = User::findOrFail($id);
        
        // Asegúrate de que el usuario tenga un modelo relacionado antes de continuar
        if ($user->userable) {
            // Accede al modelo relacionado (Estudiante, Director o Consejero)
            $userable = $user->userable;

            // Puedes pasar $user y $userable a tu vista para mostrar la información del usuario y del modelo relacionado
            return view('users.edit', compact('user', 'userable', 'roles', 'cursos'));
        }

        // Manejar el caso en que el usuario no tenga un modelo relacionado
        return abort(404);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Lógica para actualizar un usuario existente
        // Validación de datos
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'tipo' => 'required|integer', // Ajusta los valores permitidos
            // 'password' => 'required|min:6',
        ]);
        // return $request;
        $user = User::findOrFail($id);
        // return $user;
        // Actualizar los atributos del modelo
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->tipo = $request->input('tipo');
        // $user->password = bcrypt($request->input('password'));
        // ... actualiza otros atributos según sea necesario ...

        // Guardar los cambios
        $user->save();

        // Redirigir a la vista del usuario editado
        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Lógica para eliminar un usuario
    }

    public function import(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'excel_file' => 'required|mimes:xlsx,xls',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            Excel::import(new ExcelImport, $request->file('excel_file'));
         //   return "hoals54654";
            session()->flash('success', '¡Los datos se han importado con éxito!');
        } catch (Exception $e) {
            session()->flash('error', 'Se ha producido un error durante la importación. Detalles: ' . $e->getMessage());
            Log::error('Error durante la importación: ' . $e->getMessage());
        }
        return redirect()->route('users.index')->with('success', 'Datos importados correctamente.');
    }


    public function import7777(Request $request)
    {
        try {

            // Validar campos específicos antes de la importación
            $validator = Validator::make($request->all(), [
                'excel_file' => 'required|mimes:xlsx,xls',
            ]);
            // return  $request;
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            // Si la validación pasa, realiza la importación
            // return  $request;
            Excel::import(new ExcelImport, $request->file('excel_file'));
            return  "dinooooooooooo";
            // Almacenar el mensaje de importación exitosa en la sesión
            session()->flash('success', '¡Los datos se han importado con éxito!');
        } catch (Exception $e) {
            // Manejar otras excepciones generales
            // Por ejemplo, puedes registrar el error o mostrar un mensaje genérico al usuario
            session()->flash('error', 'Se ha producido un error durante la importación. Detalles: ' . $e->getMessage());
            Log::error('Error durante la importación: ' . $e->getMessage());
        }
        // Redirigir a la vista index después de la importación
        return redirect()->route('users.index')->with('success', 'Datos importados correctamente.');
    }
}

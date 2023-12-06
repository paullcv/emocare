<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PreguntaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuestionarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('inicio');
        })->name('dashboard');
    });

Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');



//crea una ruta para mostrar el formulario de carga del archivo Excel:
Route::get('/import', [ExcelController::class, 'showImportForm'])->name('users.import');

//crea una ruta para procesar la importación del archivo Excel:
Route::post('/import', [ExcelController::class, 'import'])->name('data.import');

Route::get('/export', [ExcelController::class, 'export'])->name('data.export');

Route::get('/edit-data/{id}', [ExcelController::class, 'edit'])->name('edit-data');

Route::post('/edit_data/{id}', [ExcelController::class, 'store'])->name('edit-data-post');
//---------------------------------------------------------------------------------------------

Route::resource('users', UserController::class);
// Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
//Route::post('users/import', [UserController::class, 'import'])->name('users.import');
  //      return view('inicio');
 //   })->name('inicio');
    

//Cuestionario
Route::get('/cuestionarios', [CuestionarioController::class, 'index'])->name('cuestionarios.index');
Route::get('/cuestionarios/create', [CuestionarioController::class, 'create'])->name('cuestionarios.create');
Route::get('/cuestionarios/{cuestionario}/edit', [CuestionarioController::class, 'edit'])->name('cuestionarios.edit');
Route::post('/cuestionarios', [CuestionarioController::class, 'sendData'])->name('cuestionarios.save');
Route::put('/cuestionarios/{cuestionario}', [CuestionarioController::class, 'update'])->name('cuestionarios.update');
Route::delete('/cuestionarios/{cuestionario}', [CuestionarioController::class, 'destroy'])->name('cuestionarios.delete');


//Preguntas
Route::get('/preguntas', [PreguntaController::class, 'index'])->name('preguntas.index');
Route::get('/preguntas/create', [PreguntaController::class, 'create'])->name('preguntas.create');
Route::post('/preguntas', [PreguntaController::class, 'sendData'])->name('preguntas.save');
Route::get('/preguntas/{pregunta}/edit', [PreguntaController::class, 'edit'])->name('preguntas.edit');
Route::put('/preguntas/{pregunta}', [PreguntaController::class, 'update'])->name('preguntas.update');
Route::delete('/preguntas/{pregunta}', [PreguntaController::class, 'destroy'])->name('preguntas.delete');

<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PreguntaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuestionarioController;
use App\Http\Controllers\IAController;
use App\Http\Controllers\PerfilEmocionaleController;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\SesionApoyoController;
use App\Models\PerfilEmocionale;

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


//Cuestionario
Route::get('/cuestionarios', [CuestionarioController::class, 'index'])->name('cuestionarios.index');
Route::get('/cuestionarios/create', [CuestionarioController::class, 'create'])->name('cuestionarios.create');
Route::get('/cuestionarios/{cuestionario}/edit', [CuestionarioController::class, 'edit'])->name('cuestionarios.edit');
Route::post('/cuestionarios', [CuestionarioController::class, 'sendData'])->name('cuestionarios.save');
Route::put('/cuestionarios/{cuestionario}', [CuestionarioController::class, 'update'])->name('cuestionarios.update');
Route::delete('/cuestionarios/{cuestionario}', [CuestionarioController::class, 'destroy'])->name('cuestionarios.delete');

Route::get('/cuestionarios/enviar/{cuestionario}', [CuestionarioController::class, 'enviar'])->name('cuestionarios.enviar');



//Preguntas
Route::get('/preguntas', [PreguntaController::class, 'index'])->name('preguntas.index');
Route::get('/preguntas/create', [PreguntaController::class, 'create'])->name('preguntas.create');
Route::post('/preguntas', [PreguntaController::class, 'sendData'])->name('preguntas.save');
Route::get('/preguntas/{pregunta}/edit', [PreguntaController::class, 'edit'])->name('preguntas.edit');
Route::put('/preguntas/{pregunta}', [PreguntaController::class, 'update'])->name('preguntas.update');
Route::delete('/preguntas/{pregunta}', [PreguntaController::class, 'destroy'])->name('preguntas.delete');


Route::get('/ia', [IAController::class, 'analizarSentimientos'])->name('ia.index');


//Respuestas
// Rutas para CRUD de respuestas
Route::get('/respuestas', [RespuestaController::class, 'index'])->name('responder.index');
Route::post('/respuestas/{cuestionario}', [RespuestaController::class, 'guardarRespuestas'])->name('respuestas.guardar');
Route::get('/respuestas/{cuestionario}', [RespuestaController::class, 'responder'])->name('respuesta.responder');


//Perfil Emocional
Route::get('/perfilEmocional', [PerfilEmocionaleController::class, 'index'])->name('perfilEmocional.index');
Route::get('/perfilemocional/{estudiante}', [PerfilEmocionaleController::class, 'ver'])->name('perfilemocional.ver');

//Sesion de Apoyo
Route::get('/sesionesApoyo', [SesionApoyoController::class, 'index'])->name('sesiones.index');
Route::get('/sesionesApoyo/create', [SesionApoyoController::class, 'create'])->name('sesiones.create');
Route::post('/sesionesApoyo', [SesionApoyoController::class, 'sendData'])->name('sesiones.save');
Route::get('/sesionesApoyo/{sesion}/edit', [SesionApoyoController::class, 'edit'])->name('sesiones.edit');
Route::put('/sesionesApoyo/{sesion}', [SesionApoyoController::class, 'update'])->name('sesiones.update');
Route::delete('/sesionesApoyo/{sesion}', [SesionApoyoController::class, 'destroy'])->name('sesiones.delete');

Route::get('/misSesiones', [SesionApoyoController::class, 'misSesiones'])->name('missesiones.index');
Route::get('/misSesiones/recomendacion/{sesionapoyo}', [SesionApoyoController::class, 'misRecomendaciones'])->name('misrecomendaciones.index');

<?php

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
    

//Cuestionario
Route::get('/cuestionarios', [CuestionarioController::class, 'index'])->name('cuestionarios.index');
Route::get('/cuestionarios/create', [CuestionarioController::class, 'create'])->name('cuestionarios.create');
Route::get('/cuestionarios/{cuestionario}/edit', [CuestionarioController::class, 'edit'])->name('cuestionarios.edit');
Route::post('/cuestionarios', [CuestionarioController::class, 'sendData'])->name('cuestionarios.save');
Route::put('/cuestionarios/{cuestionario}', [CuestionarioController::class, 'update'])->name('cuestionarios.update');
Route::delete('/cuestionarios/{cuestionario}', [CuestionarioController::class, 'destroy'])->name('cuestionarios.delete');

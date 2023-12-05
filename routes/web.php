<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::post('users/import', [UserController::class, 'import'])->name('users.import');

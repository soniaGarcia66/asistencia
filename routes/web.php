<?php

use Illuminate\Support\Facades\Route;
//SOLUCION A(Target class [PersonasController] does not exist):
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/personas', [PersonaController::class, 'index'])->name("persona");
Route::get('/personas/create', [PersonaController::class, 'create'])->name("persona.create");
Route::post('/personas/create', [PersonaController::class, 'store']);
//OPTAR POR: (asume q en el controlador tenemos todoslos metodos 
//anteriores ylos gnera Automaticamente pra no tner q hacerlo a mano)

Route::get('descargar-archivo/{persona}', [PersonaController::class, 'descargarArchivo'])
    ->name('descargar');

Route::resource('persona', PersonaController::class)->middleware('auth');//IMPORTANTE. despues se agrego el middleware

Route::resource('service', ServiceController::class);
Route::resource('project', ProjectController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
/*
Route::middleware('web')
    ->group(base_path('routes/web.php'));*/

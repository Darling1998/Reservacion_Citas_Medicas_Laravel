<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth','admin'])->group(function () {
    Route::get('/especialidades',[App\Http\Controllers\Admin\EspecialidadController::class, 'index']);
    Route::get('/especialidades/crear',[App\Http\Controllers\Admin\EspecialidadController::class, 'crear']); //muestra el formulario de registro
    Route::get('/especialidades/{especialidad}/editar',[App\Http\Controllers\Admin\EspecialidadController::class, 'editar']);//nos dirige a la vista de editar
    Route::post('/especialidades',[App\Http\Controllers\Admin\EspecialidadController::class, 'guardar']); //envia el fromulario de registro
    Route::put('/especialidades/{especialidad}',[App\Http\Controllers\Admin\EspecialidadController::class, 'actualizar']); //actualiza una especialidad
    Route::delete('/especialidades/{especialidad}',[App\Http\Controllers\Admin\EspecialidadController::class, 'eliminar']); //elimina una especialidad

    //Rutas para Médicos
    Route::get('/medicos',[App\Http\Controllers\Admin\MedicoController::class, 'index']);
    Route::get('/medicos/crear',[App\Http\Controllers\Admin\MedicoController::class, 'crear']); //muestra el formulario de registro
    Route::get('/medicos/{medico}/editar',[App\Http\Controllers\Admin\MedicoController::class, 'editar']);//nos dirige a la vista de editar
    Route::post('/medicos',[App\Http\Controllers\Admin\MedicoController::class, 'guardar']); //envia el fromulario de registro
    Route::put('/medicos/{medico}',[App\Http\Controllers\Admin\MedicoController::class, 'actualizar']); //actualiza un medico
    Route::delete('/medicos/{medico}',[App\Http\Controllers\Admin\MedicoController::class, 'eliminar']); //elimina un medico
});


Route::middleware(['auth','medico'])->group(function () {
   
    Route::get('/horario',[App\Http\Controllers\Medico\HorarioController::class, 'editar']);
    Route::post('/horario',[App\Http\Controllers\Medico\HorarioController::class, 'guardar']);
});

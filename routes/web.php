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


//Rutas para especialidades
Route::get('/especialidades',[App\Http\Controllers\EspecialidadController::class, 'index']);
Route::get('/especialidades/crear',[App\Http\Controllers\EspecialidadController::class, 'crear']); //muestra el formulario de registro
Route::get('/especialidades/{especialidad}/editar',[App\Http\Controllers\EspecialidadController::class, 'editar']);//nos dirige a la vista de editar
Route::post('/especialidades',[App\Http\Controllers\EspecialidadController::class, 'guardar']); //envia el fromulario de registro
Route::put('/especialidades/{especialidad}',[App\Http\Controllers\EspecialidadController::class, 'actualizar']); //actualiza una especialidad
Route::delete('/especialidades/{especialidad}',[App\Http\Controllers\EspecialidadController::class, 'eliminar']); //elimina una especialidad

//Rutas para Médicos
Route::get('/medicos',[App\Http\Controllers\MedicoController::class, 'index']);
Route::get('/medicos/crear',[App\Http\Controllers\MedicoController::class, 'crear']); //muestra el formulario de registro
Route::get('/medicos/{medico}/editar',[App\Http\Controllers\MedicoController::class, 'editar']);//nos dirige a la vista de editar
Route::post('/medicos',[App\Http\Controllers\MedicoController::class, 'guardar']); //envia el fromulario de registro
Route::put('/medicos/{medico}',[App\Http\Controllers\MedicoController::class, 'actualizar']); //actualiza un medico
Route::delete('/medicos/{medico}',[App\Http\Controllers\MedicoController::class, 'eliminar']); //elimina un medico
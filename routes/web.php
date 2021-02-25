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

   // Route::resource('medicos','Admin\MedicoController');
    Route::get('/medicos',[App\Http\Controllers\Admin\MedicoController::class, 'index']);
    Route::get('/medicos/create',[App\Http\Controllers\Admin\MedicoController::class, 'create']); //muestra el formulario de registro
    Route::get('/medicos/{medico}/edit',[App\Http\Controllers\Admin\MedicoController::class, 'edit']);//nos dirige a la vista de editar
    Route::post('/medicos',[App\Http\Controllers\Admin\MedicoController::class, 'store']); //envia el fromulario de registro
    Route::put('/medicos/{medico}',[App\Http\Controllers\Admin\MedicoController::class, 'update']); //actualiza un medico
    Route::delete('/medicos/{medico}',[App\Http\Controllers\Admin\MedicoController::class, 'destroy']); //elimina un medico
   
});


Route::middleware(['auth','medico'])->group(function () {
   
    Route::get('/horario',[App\Http\Controllers\Medico\HorarioController::class, 'editar']);
    Route::post('/horario',[App\Http\Controllers\Medico\HorarioController::class, 'guardar']);
});


//JSON PARA LA API medicos asociados a una especialidad
Route::get('/especialidades/{especialidad}/medicos',[App\Http\Controllers\Api\EspecialidadController::class, 'medicos']);
Route::get('/horarios/horas',[App\Http\Controllers\Api\HorarioController::class, 'horas']);
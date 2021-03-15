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

    //paciente
    Route::get('/pacientes',[App\Http\Controllers\Admin\PacienteController::class, 'index']);
   

    //reportes
    Route::get('/reportes/citas/lineas',[App\Http\Controllers\Admin\ReporteController::class, 'citas']);
    //vista de medicos
    Route::get('/reportes/medicos/barras',[App\Http\Controllers\Admin\ReporteController::class, 'medicos']);
    //data de medicos en json 
    Route::get('/reportes/medicos/barras/infor',[App\Http\Controllers\Admin\ReporteController::class, 'medicosJson']);

});


Route::middleware(['auth','medico'])->group(function () {
   
    Route::get('/horario',[App\Http\Controllers\Medico\HorarioController::class, 'editar']);
    Route::post('/horario',[App\Http\Controllers\Medico\HorarioController::class, 'guardar']);
});

Route::post('/citas',[App\Http\Controllers\CitaController::class, 'store']);//guardar cita

Route::middleware('auth')->group(function () {
   
    Route::get('/citas',[App\Http\Controllers\CitaController::class, 'index']);
    Route::get('/citas/{cita}',[App\Http\Controllers\CitaController::class, 'mostrarDetalle']); //mostrar informacion de una cita especifica
    //Route::post('/citas',[App\Http\Controllers\CitaController::class, 'store']);//guardar cita

    Route::get('/citas/{cita}/cancelar',[App\Http\Controllers\CitaController::class, 'mostrarFormCancelar']); //muestra el formulario de cancelar el textarea pra la notificacion
	Route::post('/citas/{cita}/cancelar' ,[App\Http\Controllers\CitaController::class, 'cancel']);//cancela la cita medica

	 Route::post('/citas/{cita}/confirmar', [App\Http\Controllers\CitaController::class, 'postConfirmar']); 

});
Route::get('/horarios/horas',[App\Http\Controllers\Api\HorarioController::class, 'horas']);

//JSON PARA LA API medicos asociados a una especialidad
 /* Route::get('/especialidades/{especialidad}/medicos',[App\Http\Controllers\Api\EspecialidadController::class, 'medicos']);
Route::get('/horarios/horas',[App\Http\Controllers\Api\HorarioController::class, 'horas']);
Route::get('/especialidades',[App\Http\Controllers\Api\EspecialidadController::class, 'index']);  */
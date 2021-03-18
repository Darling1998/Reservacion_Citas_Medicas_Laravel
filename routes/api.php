<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/especialidades',[App\Http\Controllers\Api\EspecialidadController::class, 'index']);
Route::get('/especialidades/{especialidad}/medicos',[App\Http\Controllers\Api\EspecialidadController::class, 'medicos']);
Route::get('/horarios/horas',[App\Http\Controllers\Api\HorarioController::class, 'horas']);


/* Route::middleware('auth:api')->get('/user', function (Request $request) {
       
    return $request->user();
}); */

Route::post('/registro',[App\Http\Controllers\Api\AuthController::class, 'registro']);
Route::post('/login',[App\Http\Controllers\Api\AuthController::class, 'login']);

//solo pueden acceder los usuarios logueados mediante la api
Route::middleware('auth:api')->group(function () {
    
    //para citas
    Route::get('/citas',[App\Http\Controllers\Api\CitaController::class, 'index']);

    //informacion de usuario
    Route::get('/user',[App\Http\Controllers\Api\UserController::class,'mostrar']);
    Route::post('/citas',[App\Http\Controllers\Api\CitaController::class, 'store']);


    Route::post('/fcm/token',[App\Http\Controllers\Api\FcmController::class, 'guardarToken']);
});


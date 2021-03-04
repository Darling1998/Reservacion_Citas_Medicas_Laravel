<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/especialidades',[App\Http\Controllers\Api\EspecialidadController::class, 'index']);
Route::get('/especialidades/{especialidad}/medicos',[App\Http\Controllers\Api\EspecialidadController::class, 'medicos']);
Route::get('/horarios/horas',[App\Http\Controllers\Api\HorarioController::class, 'horas']);


Route::get('/citas',[App\Http\Controllers\Api\CitaController::class, 'index']);

Route::post('/citas',[App\Http\Controllers\Api\CitaController::class, 'store']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
       
    return $request->user();
});


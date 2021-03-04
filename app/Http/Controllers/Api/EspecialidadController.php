<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
    public function index(){
        return Especialidad::all(['id','nombre']);
    }
   
    public function medicos(Especialidad $especialidad){
        //obtenemos los medicos con su especialidad
        return  $especialidad->usuarios()->get(['users.id','users.name']);
    
    }
}

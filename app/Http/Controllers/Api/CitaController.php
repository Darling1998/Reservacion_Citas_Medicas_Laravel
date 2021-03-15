<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCita;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index(Request $request){
        $paciente_id=$request->input('paciente_id');
        return Cita::where('paciente_id',$paciente_id)->get();
         ;
    }

     public function store(StoreCita $request){
        
        $cita= Cita::crearCitaPaciente($request);

            	
    	if ($cita) 
            $success = true;
        else 
            $success = false;

        return compact('success');
    } 
}

<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCita;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CitaController extends Controller
{    public function index(){
    
       $user= Auth::guard('api')->user();
       $cita =$user->citascomoPaciente()->with(['especialidad' =>function($query){
            $query->select('id','nombre');
       },'medico'=>function($query){
            $query->select('id','name');
       }])->orderBy('created_at','desc')
       ->get(['id','descripcion','especialidad_id','medico_id','tipo','estado','created_at','hora_cita','fecha_cita']);
       
       return $cita;
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

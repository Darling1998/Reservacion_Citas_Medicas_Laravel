<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiaTrabajo;

class HorarioController extends Controller
{
   public function editar(){

    $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sabado','Domingo'];
       return view('horario',compact('dias'));
  
    }

   
    public function guardar(Request $request){
     // dd($request->all());

      $activo= $request->input('activo')?:[];//si no existe un dia activo es un arreglo vacio
      $hora_inicio_mñn= $request->input('hora_inicio_mñn');
      $hora_fin_mñn= $request->input('hora_fin_mñn');
      $hora_inicio_tarde= $request->input('hora_inicio_tarde');
      $hora_fin_tarde= $request->input('hora_fin_tarde');

      for($i=0;$i<7;++$i)
         DiaTrabajo::updateOrCreate(
            [
               'dia'=>$i,
               'user_id'=>auth()->id()
            ],
            [  
               'activo'=>in_array($i,$activo),//buscamos el dia ctivo dentro de la lista
               'hora_inicio_mñn'=>$hora_inicio_mñn[$i],
               'hora_fin_mñn'=>$hora_fin_mñn[$i],
               'hora_inicio_tarde'=>$hora_inicio_tarde[$i],
               'hora_fin_tarde'=>$hora_fin_tarde[$i]
               ]
         );
         return back();
    }
}

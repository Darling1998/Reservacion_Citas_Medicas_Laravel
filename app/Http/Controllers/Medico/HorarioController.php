<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiaTrabajo;
use Carbon\Carbon;

class HorarioController extends Controller
{
   private $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sabado','Domingo'];
   
   public function editar(){

      $dias_trabajo=DiaTrabajo::where('user_id',auth()->id())->get();

      if (count($dias_trabajo) > 0) {
      //mapeamos la coleccion para poder convertir la fecha
         $dias_trabajo->map(function ($diatrabajo) {
            $diatrabajo->hora_inicio_mñn = (new Carbon($diatrabajo->hora_inicio_mñn))->format('g:i A');
            $diatrabajo->hora_fin_mñn = (new Carbon($diatrabajo->hora_fin_mñn))->format('g:i A');
            $diatrabajo->hora_inicio_tarde = (new Carbon($diatrabajo->hora_inicio_tarde))->format('g:i A');
            $diatrabajo->hora_fin_tarde = (new Carbon($diatrabajo->hora_fin_tarde))->format('g:i A');
            return $diatrabajo;
         });
      } else {
         $dias_trabajo = collect();
         for ($i=0; $i<7; ++$i)
             $dias_trabajo->push(new DiaTrabajo());
      }

      //dd($dias_trabajo->toArray());
      //compact toma las varibales declaradas localmente
      $dias = $this->dias;
      return view('horario',compact('dias_trabajo','dias'));
  
    }

   
    public function guardar(Request $request){
     //dd($request->all());

      $activo= $request->input('activo')?:[];//si no existe un dia activo es un arreglo vacio
      $hora_inicio_mñn= $request->input('hora_inicio_mñn');
      $hora_fin_mñn= $request->input('hora_fin_mñn');
      $hora_inicio_tarde= $request->input('hora_inicio_tarde');
      $hora_fin_tarde= $request->input('hora_fin_tarde');

      $alertas=[];

      for($i=0;$i<7;++$i){

         if($hora_inicio_mñn[$i]>=$hora_fin_mñn[$i]){
            $alertas[]='Las horas del turno de la mañana contienen inconsistencias en el dia '.$this->dias[$i].'.';
         }
         if($hora_inicio_tarde[$i]>$hora_fin_tarde[$i]){
            $alertas[]='Las horas del turno de la tarde contienen inconsistencias en el dia '.$this->dias[$i].'.';
         }

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

      }

      if(count($alertas)>0){
         //no inyecta ninguna variable a la vista el back ni el redirecto
         return back()->with(compact('alertas'));
      }
         $notificacion ='Horarios guardados correctamente';
         return back()->with(compact('notificacion'));
    }
}

<?php

namespace App\Servicios;

use App\Interfaces\HorarioServicioInterface;
use App\Models\Cita;
use App\Models\DiaTrabajo;
use Carbon\Carbon;

class HorarioServicio implements HorarioServicioInterface{

    private function getDiaDeFecha($fecha){
        
        $dateCarbon = new Carbon($fecha);
        //carbon trabaja asi: 0 es domingo y 6 es sabado
        
        $i = $dateCarbon->dayOfWeek;
        $dia =($i==0 ? 6 : $i-1);
        return $dia;
    }

    public function obtenerIntervalosDisponibles($fecha,$medico_id){
        
        //traemos todos los horarios de un medico
        $diaTrabajo= DiaTrabajo::where('activo',true)
        ->where('dia',$this->getDiaDeFecha($fecha))
        ->where('user_id',$medico_id)
        ->first([
            'hora_inicio_mñn','hora_fin_mñn',
            'hora_inicio_tarde','hora_fin_tarde',
        ]);

        if($diaTrabajo){
    
            $intervalos_mñn=$this->obtenerIntervalos(
                $diaTrabajo->hora_inicio_mñn,$diaTrabajo->hora_fin_mñn,$fecha,$medico_id
            );
            $intervalos_tarde=$this->obtenerIntervalos(
                $diaTrabajo->hora_inicio_tarde,$diaTrabajo->hora_fin_tarde,$fecha,$medico_id
            );
            
        }else{
            $intervalos_mñn=[];
            $intervalos_tarde=[];
        }
            $data=[];
            $data['manana']=$intervalos_mñn;
            $data['tarde']=$intervalos_tarde;
        return $data;
    }

    private function obtenerIntervalos($inicio, $fin , $date, $medico_id ) {
		$inicio = new Carbon($inicio);
    	$fin = new Carbon($fin);

    	$intervals = [];

    	while ($inicio < $fin) {
    		$interval = [];

    		$interval['inicio']  = $inicio->format('g:i A');

           $disponible = $this->disponibilidadIntervalo($date, $medico_id, $inicio);

    		$inicio->addMinutes(30);
    		$interval['fin']  = $inicio->format('g:i A');

            //sino existe una cita para esta hora con este medico
            if ($disponible) {
                $intervals []= $interval;           //ese intervalo entra a los intervalos disponibles
            }     		
    	}

    	return $intervals;
    }


    //buscamos la citas asociadas al medico y la hora de inicio
    public function disponibilidadIntervalo($date, $medico_id, Carbon $inicio) {
        $exists = Cita::where('medico_id', $medico_id)
                ->where('fecha_cita', $date)
                ->where('hora_cita', $inicio->format('H:i:s'))
                ->exists();

        return !$exists; //disponibles si no existe
    }
}


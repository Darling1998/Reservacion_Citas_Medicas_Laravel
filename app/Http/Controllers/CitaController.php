<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function store(Request $request){

        $data=$request->only([        'descricpion',
        'especialidad_id',
        'medico_id',
        'paciente_id',
        'fecha_cita',
        'hora_cita'
        ]);

        Cita::create($data);
        
        $noticacion='Cita registrada correctamente';
        return back()->with(compact('notificacion'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\DiaTrabajo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function horas(Request $request){
        DiaTrabajo::where('activo',true)->where('dia',0);
    }
}

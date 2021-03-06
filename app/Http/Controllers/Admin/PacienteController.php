<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PacienteController extends Controller
{
    public function index(){
        $pacientes = User::pacientes()->paginate(10); 
        return view('pacientes.index',compact('pacientes'));
    }
}

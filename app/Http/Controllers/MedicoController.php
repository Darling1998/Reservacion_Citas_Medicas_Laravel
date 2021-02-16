<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MedicoController extends Controller
{
    
    public function index(){
         $medicos = User::all(); 
        return view('medicos.index',compact('medicos'));
    }

    public function crear(){
        return view('medicos.crear');
    }

    public function editar(User $medico){
        
        return view('medicos.editar',compact('medico'));
    }

    public function guardar(Request $request){
        dd($request->all());        

        //validaciones
         $reglas=[
            'nombre'=>'required|min:4'
        ];

        $alertas=[
            'nombre.required'=>'Ingrese un nombre',
            'nombre.min'=>'Ingresar minimo 4 caracteres'
        ];

        $this->validate($request,$reglas,$alertas);
        $medico = new User();
        $medico->nombre = $request->input('name');
        $medico->apellido = $request->input('apellido');
        $medico->save();
        return redirect('/medicos');
    }


    public function actualizar(Request $request,User $medico){
        //validaciones
        $reglas=[
            'nombre'=>'required|min:4'
        ];

        $alertas=[
            'nombre.required'=>'Ingrese un nombre',
            'nombre.min'=>'Ingresar minimo 4 caracteres'
        ];

        $this->validate($request,$reglas,$alertas);

        $medico->name = $request->input('name');
        $medico->apellido = $request->input('apellido');
        $medico->email = $request->input('email');
        $medico->password = $request->input('password');
        $medico->cedula = $request->input('cedula');
        $medico->rol_id = 2;
        $medico->save();
        return redirect('/medicos'); 
    }

    public function eliminar(User $medico){
        $medico->delete();
        return redirect('/medicos');
    } 
}

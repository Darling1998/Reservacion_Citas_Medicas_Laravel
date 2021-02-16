<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
    public function index(){
        $especialidades = Especialidad::all();
        return view('especialidades.index',compact('especialidades'));
    }

    public function crear(){
        return view('especialidades.crear');
    }

    public function editar(Especialidad $especialidad){
        
        return view('especialidades.editar',compact('especialidad'));
    }

    public function guardar(Request $request){
        //dd($request->all());        

        //validaciones
        $reglas=[
            'nombre'=>'required|min:4'
        ];

        $alertas=[
            'nombre.required'=>'Ingrese un nombre',
            'nombre.min'=>'Ingresar minimo 4 caracteres'
        ];

        $this->validate($request,$reglas,$alertas);
        $especialidad = new Especialidad();
        $especialidad->nombre = $request->input('nombre');
        $especialidad->descripcion = $request->input('descripcion');
        $especialidad->save();
        return redirect('/especialidades');
    }


    public function actualizar(Request $request,Especialidad $especialidad){
        //validaciones
        $reglas=[
            'nombre'=>'required|min:4'
        ];

        $alertas=[
            'nombre.required'=>'Ingrese un nombre',
            'nombre.min'=>'Ingresar minimo 4 caracteres'
        ];

        $this->validate($request,$reglas,$alertas);

        $especialidad->nombre = $request->input('nombre');
        $especialidad->descripcion = $request->input('descripcion');
        $especialidad->save();
        return redirect('/especialidades');
    }

    public function eliminar(Especialidad $especialidad){
        $especialidad->delete();
        return redirect('/especialidades');
    }
}

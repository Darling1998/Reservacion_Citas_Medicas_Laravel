<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

class MedicoController extends Controller
{
    
    public function index(){
         $medicos = User::where('role_id','2')->get(); 
        return view('medicos.index',compact('medicos'));
    }

    public function crear(){
        return view('medicos.crear');
    }

    public function editar(User $medico){
        
        return view('medicos.editar',compact('medico'));
    }

    public function guardar(Request $request){
      //  dd($request->all());        

        //validaciones
         $reglas=[
            'name'=>'required|min:3',
            'apellido'=>'required|min:3',
            'cedula'=>'nullable|digits:10',
            'telefono'=>'nullable|min:7',
            'email'=>'required|email',

        ];

         $this->validate($request,$reglas);

         //asignacion masiva
        /* User::create(
            $request->only('name','apellido','cedula','telefono','email')
            +[
                'role_id'=>$request->input('role_id'),
                'password'=>bcrypt($request->input('contra'))
            ]
        );  */

        $medico = new User();
        $medico->name= $request->input('name');
        $medico->email= $request->input('email');
        $medico->cedula= $request->input('cedula');
        $medico->apellido= $request->input('apellido');
        $medico->telefono= $request->input('telefono');
        $medico->direccion = $request->input('direccion');
        $medico->password= bcrypt($request->input('contra'));
        $medico->role_id=$request->input('role_id');
        $medico->save();
        $alerta = 'Medico agregado con éxito';
        return redirect('/medicos')->with(compact('alerta'));
    }
    /* DnIO7Vcc */

    public function actualizar(Request $request,User $medico){
        //validaciones
        $reglas=[
            'name'=>'required|min:3',
            'apellido'=>'required|min:3',
            'cedula'=>'nullable|digits:10',
            'telefono'=>'nullable|min:7',
            'email'=>'required|email',
            'password'=>'nullable',

        ];


        $this->validate($request,$reglas);
        $data = $request->only('name','apellido','cedula','telefono','email');
      
        $medico->name = $request->input('name');
        $medico->apellido = $request->input('apellido');
        $medico->cedula = $request->input('cedula');
        $medico->telefono = $request->input('telefono');
        $medico->email = $request->input('email');
        $medico->password = bcrypt($request->input('password'));
        $medico->save();
            return redirect('/medicos');

       $alerta = 'Datos del médico actualizados con éxito';
        return redirect('/medicos')->with(compact('alerta'));
    }

    public function eliminar(User $medico){
        $medico->delete();
        return redirect('/medicos');
    } 
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Especialidad;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = User::medicos()->get(); 
        return view('medicos.index',compact('medicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = Especialidad::all();
        return view('medicos.create',compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());        

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
        $user=  User::create(
            $request->only('name','apellido','cedula','telefono','email')
            +[
                'role_id'=>$request->input('role_id'),
                'password'=>bcrypt($request->input('contra'))
            ]
        );  
        
        $user->especialidades()->attach($request->input('especialidades'));
        $notificacion = 'El médico se ha registrado correctamente.';
        return redirect('/medicos')->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //***EDITAR */
    public function edit($id)
    {
        $medico = User::medicos()->findOrFail($id);
        $especialidades = Especialidad::all();

        //traer especialidades desde el servidor
       $id_especialidades = $medico->especialidades()->pluck('especialidads.id');
       
        return view('medicos.edit',compact('medico','especialidades','id_especialidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
     {
        $reglas=[
            'name'=>'required|min:3',
            'apellido'=>'required|min:3',
            'cedula'=>'nullable|digits:10',
            'telefono'=>'nullable|min:7',
            'email'=>'required|email',
            'password'=>'nullable',

        ];


        $this->validate($request,$reglas);

        $user=User::medicos()->findOrFail($id);

        $data = $request->only('name','apellido','cedula','telefono','email');
      
        $password = $request->input('password');
        if ($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save(); // UPDATE

        //accedemos a las especialidades del usuario sync para sincronizar las especialidades del value actual
        $user->especialidades()->sync($request->input('especialidades'));

        $notificacion = 'La información del médico se ha actualizado correctamente.';
        return redirect('/medicos')->with(compact('notificacion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $medico)
    {
        $nombreMedico = $medico->name;
        $medico->delete();

        $notificacion = "El médico $nombreMedico se ha eliminado correctamente.";
        return redirect('/medicos')->with(compact('notificacion'));
    }
}

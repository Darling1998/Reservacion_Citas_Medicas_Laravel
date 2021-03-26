<?php

namespace App\Http\Controllers;
use App\Models\Cita;
use App\Models\CitaCancelada;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCita;



class CitaController extends Controller
{
    public function index (){

        $role=auth()->user()->role_id;

        //consultas para el administrador
        if($role==1){
            $citasPendientes = Cita::where('estado','Reservada')->paginate(10);
            $citasConfirmadas = Cita::where('estado','Confirmada')->paginate(10);
            $citasViejas= Cita::whereIn('estado',['Cancelada','Atendida'])->orderby('fecha_cita','DESC')->paginate(10);
        //consultas para el medico
        }else{
            $citasPendientes = Cita::where('estado','Reservada')->where('medico_id',auth()->id())->paginate(10);
            $citasConfirmadas = Cita::where('estado','Confirmada')->where('medico_id',auth()->id())->paginate(10);
            $citasViejas= Cita::whereIn('estado',['Cancelada','Atendida'])->where('medico_id',auth()->id())->paginate(10);
        }

        return view('citas.index',compact('citasConfirmadas','citasPendientes','citasViejas','role'));
    }
 
/*       public function create(HorarioServicioInterface $horarioServicio){
        $especialidades = Especialidad::all();

        $especialidad_id = old('especialidad_id');
        if ($especialidad_id) {
            $especialidad = Especialidad::find($especialidad_id);
            $doctors = $especialidad->users;
        } else {
            $doctors = collect();
        }
        
        $date = old('dia_cita');
        $medico_id = old('medico_id');

        //si hay una fecha y un medico seleccionado se procede a buscar los intervalos disponible

        if ($date && $medico_id) {
            $intervalos_horas = $horarioServicio->obtenerIntervalosDisponibles($date, $medico_id);
        } else {
            $intervalos_horas = null;
        }
        
    	return view('citas.create', compact('especialidades', 'doctors', 'intervalos_horas'));
    }   
 */
   // public function store(StoreCita $request){

       
      // $validator = Validator::make($request->all(),$reglas,$mensajes);
        //$this->validate($request,$reglas,$mensajes);


    /*     $validator->after(function($validator) use ($request,$horarioServicio){
              if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        }); */
 
 
      //  Cita::crearCitaPaciente($request,auth()->id());
        
       // $notificacion='Cita registrada correctamente';
       // return back()->with(compact('notificacion'));
    //}  

    public function cancel(Cita $cita,Request $request){

         if($request->has('justificacion')){
            $cancell = new CitaCancelada();
            $cancell->justificacion = $request->input('justificacion');
            $cancell->cancelado_por_id= auth()->id();
        
            $cita->cancelacion()->save($cancell);
        }
       
        $cita->estado='Cancelada';

        $guardado = $cita->save();

        if ($guardado){
         $cita->paciente->enviarFCM('Su cita ha sido cancelada');
        }
       
 

        $notificacion='La cita se ha cancelado correctamente';
       // dd($cita,$request);
        return redirect('/citas')->with(compact('notificacion'));
    }

    public function postConfirmar(Cita $cita){

    
       $cita->estado='Confirmada';
       
       $guardado = $cita->save();

       if ($guardado){
        $cita->paciente->enviarFCM('Su cita se ha confirmado');
       }
      

       

       $notificacion='La cita se ha confirmado correctamente';
      // dd($cita,$request);
       return redirect('/citas')->with(compact('notificacion'));
   }

    public function mostrarFormCancelar(Cita $cita){
        if($cita->estado == 'Confirmada'){
           $role = auth()->user()->role_id;
           return view ('citas.cancel',compact('cita','role'));
        }
        
        return redirect('/citas');
    }


    public function mostrarDetalle(Cita $cita){
        $role = auth()->user()->role_id;
        return view ('citas.mostrarcita',compact('cita','role'));
    }

}

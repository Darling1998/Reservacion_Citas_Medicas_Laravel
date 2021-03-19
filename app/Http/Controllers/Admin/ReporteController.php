<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use PDF;
class ReporteController extends Controller
{
    public function citas(){
        $cantxmes = Cita::select (
            DB::raw('MONTH(created_at) as mes'), 
            DB::raw('COUNT(1) as cantidad')
        )->groupBy('mes')->get()->toArray();
    
       $cantidades =array_fill(0,12,0);

       foreach ($cantxmes as $cantidadMes){
        $inicio = $cantidadMes['mes']-1;
        $cantidades[$inicio]=$cantidadMes['cantidad'];
       }

        return view('reportes.citas',compact('cantidades'));
    }


    public function medicos(){

        $actual=Carbon::now();
        $inicio = $actual->subYear()->format('Y-m-d');
        $fin=$actual->format('Y-m-d');
        return view('reportes.medicos',compact('inicio','fin'));
    }


    public function medicosJson(Request $request){

        $inicio=$request->input('inicio');
        $fin=$request->input('fin');;
        $medicos = User::medicos()->select('name','apellido')
        ->withCount([
            'citasAtendidas'=>function($query) use ($inicio,$fin){
            $query->whereBetween('fecha_cita',[$inicio,$fin]);
        },
            'citasCanceladas' => function ($query) use ($inicio, $fin) {
                $query->whereBetween('fecha_cita', [$inicio, $fin]);
            } 
        
        ])
        ->orderBy('citas_atendidas_count','desc')->take(4)->get();

        //dd($medicos);

        $data =[];
        $data['categorias']=$medicos->pluck('name');

        $series=[];
        //citas atendidas
        $series1['name']='Citas Atendidas';
        $series1['data'] = $medicos->pluck('citas_atendidas_count');
        //citas canceladas
        $series2['name'] = 'Citas Canceladas';
    	$series2['data'] = $medicos->pluck('citas_canceladas_count'); 

        $series[] = $series1;
        $series[] = $series2;
        $data['series']=$series;
        return $data;
    }


    public function especialidadesDemandadas(){
        return view('reportes.especialidades');
    }

    public function especialidadesDemandadasJson(Request $request){
        $inicio=$request->input('inicio');
        $fin=$request->input('fin');;
   
        //$esp=DB::table('especialidads')->select('id','nombre')->withCount('citas')->orderBy('citas_count','desc')->take(4)->get();
         //$esp = Especialidad::withCount('citas')->orderBy('citas_count','desc')->get('citas_count')->take(3)->toArray();

        $esp=Especialidad::select(['id', 'nombre'])->withCount(['citas'=>function($quer) use ($inicio,$fin){

           // $users = DB::table('citas')->whereBetween('fecha_cita',[$inicio,$fin]);
        }]
        )->orderBy('citas_count','desc')->get()->take(4)->toArray();

       // $esp=Especialidad::select('id', 'nombre')->withCount('citas')->orderBy('citas_count','desc')->take(4)->get()->toArray();
        //dd($esp);

        $data =[];
        $data['categorias']=collect($esp)->pluck('nombre');

        $series=[];
        //citas atendidas
        $series1['name']='Total Citas Atendidas por Especialidad';
        $series1['data'] = collect($esp)->pluck('citas_count');
        //citas canceladas
    
        $series2['name'] = collect($esp)->pluck('nombre');

        $series[] = $series1;
        $series[] = $series2;
        $data['series']=$series;
        return $data; //{categories:[],series:[]}

    }


    public function cuadroCitas()
    {
    //SELECT users.name as nombre, users.apellido as apellido, especialidads.nombre FROM especialidad_user 
    //inner join users on users.id=especialidad_user.user_id 
    //inner join especialidads on especialidads.id=especialidad_user.especialidad_id
        $nomAp = DB::table('especialidad_user')
            ->join('users', 'users.id', '=', 'especialidad_user.user_id')
             ->join('especialidads', 'especialidads.id', '=', 'especialidad_user.especialidad_id')
            ->select('users.name','users.apellido','especialidads.nombre')->orderBy('especialidads.nombre')
            ->get();
       // $nomAp = User::medicos()->get();
        return view('reportes.cuadro',compact('nomAp'));
    }

    public function generarPdf(){
        $nomAp = DB::table('especialidad_user')
            ->join('users', 'users.id', '=', 'especialidad_user.user_id')
             ->join('especialidads', 'especialidads.id', '=', 'especialidad_user.especialidad_id')
            ->select('users.name','users.apellido','especialidads.nombre')->orderBy('especialidads.nombre')
            ->get();
            $pdf = PDF::loadView('reportes.cuadropdf', compact('nomAp'));
            return $pdf->download('estados_de_citas_totales.pdf');
    }
}

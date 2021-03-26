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
        ->orderBy('citas_atendidas_count','desc')->take(5)->get();

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
        $actual=Carbon::now();
        $inicio = $actual->subYear()->format('Y-m-d');
        $fin=$actual->format('Y-m-d');
      
        return view('reportes.especialidades',compact('inicio','fin'));
    }

     public function especialidadesDemandadasJson(Request $request){
        $inicio=$request->input('inicio');
        $fin=$request->input('fin');

/*   SELECT count(especialidad_id) as camtidxES, especialidads.nombre FROM citas 
    inner join especialidads on citas.especialidad_id=especialidads.id 
    group by(especialidad_id)  */



    $citas = DB::table('citas')
    ->join('especialidads', 'citas.especialidad_id', '=', 'especialidads.id')
    ->select( array('especialidads.nombre',DB::raw('count(especialidad_id) as total')))
    ->whereBetween('fecha_cita',[$inicio,$fin])
    ->groupBy('especialidad_id','especialidads.nombre')
    ->get(); 

    $data =[];
    $data['categorias']=$citas->pluck('nombre');
    $series=[];
  
    $series1['name']='Citas Atendidas';
    $series1['data'] = $citas->pluck('total');
    $series[] = $series1;
    $data['series']=$series;
    

   return $data;
   
    }
 
/* public function especialidadesDemandadasJson(Request $request){
    $inicio=$request->input('inicio');
    $fin=$request->input('fin');

    $esp=Especialidad::select(['id', 'nombre'])->withCount(['citas'=>function($quer) use ($inicio,$fin){
        $quer->whereBetween('fecha_cita',[$inicio,$fin]);
    }]
    )->orderBy('citas_count','desc')->get()->take(4)->toArray();


    $data =[];
    $data['categorias']=collect($esp)->pluck('nombre');

    $series=[];
    //citas atendidas
    $series1['name']='Total Citas por Especialidad';
    $series1['data'] = collect($esp)->pluck('citas_count');
    //citas canceladas

    $series2['name'] = collect($esp)->pluck('nombre');

    $series[] = $series1;
    $series[] = $series2;
    $data['series']=$series;
    return $data; //{categories:[],series:[]}

}
 */


    public function cuadroCitas()
    {
        $especialidades = Especialidad::all();
        $actual=Carbon::now();
        $inicio = Carbon::create(2020, 1, 1, 0, 0, 0)->format('Y-m-d');
        $fin=$actual->format('Y-m-d');

       return view('reportes.cuadro',compact('especialidades','inicio','fin'));
    }

    public function filtrar(Request $request){
        $inicio=$request->input('inicio');
        $fin=$request->input('fin');
        $ides=$request->input('select');

/*    select count(ci.especialidad_id),u.name,u.apellido, esp.nombre from citas ci 
        inner join users u on u.id=ci.medico_id 
        INNER JOIN especialidad_user espu on espu.user_id=u.id 
        inner join especialidads esp on esp.id=ci.especialidad_id where esp.id=2 
        group by u.name */

        $citas = DB::table('citas')
        ->join('users', 'users.id', '=', 'citas.medico_id')
        ->join('especialidad_user', 'especialidad_user.user_id', '=', 'users.id')
        ->join('especialidads', 'especialidads.id', '=', 'citas.especialidad_id')
        ->select(array('users.name','users.apellido','especialidads.nombre', DB::raw('count(citas.especialidad_id) as total')))
        ->where('especialidads.id', '=',$ides)
        ->whereBetween('fecha_cita',[$inicio,$fin])
        ->groupBy('users.name','users.apellido','especialidads.nombre')
        
        ->get()->toArray(); 

        return response(json_encode($citas)); 

    }

    public function generarPdf(){
        $nomAp = DB::table('especialidad_user')
            ->join('users', 'users.id', '=', 'especialidad_user.user_id')
             ->join('especialidads', 'especialidads.id', '=', 'especialidad_user.especialidad_id')
            ->select('')->orderBy('especialidads.nombre')
            ->get();
            $pdf = PDF::loadView('reportes.cuadropdf', compact('nomAp'));
            return $pdf->download('estados_de_citas_totales.pdf');
    }
}

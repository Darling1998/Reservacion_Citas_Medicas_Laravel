<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cita extends Model
{
    use HasFactory;
    protected $table ="citas"; 


    protected $fillable=[
        'descripcion',
        'especialidad_id',
        'medico_id',
        'paciente_id',
        'fecha_cita',
        'hora_cita',
        'tipo'
    ];


    //acceder desde una cita a la especialidad asociada
    public function especialidad(){
        return $this->belongsTo(Especialidad::class);
    }

    //cita->medico un medico se asocia a varios medicos
    public function medico(){
        return $this->belongsTo(User::class);
    }

    //cita->paciente
    public function paciente(){
        return $this->belongsTo(User::class);
    }

    //accessor devuelve un campo calculado
    //cita->hora_cita

    public function getHorarioTimeAttribute(){
        return (new Carbon($this->hora_cita))->format('g:i A');
    }

    public function cancelacion(){
        return $this->hasOne(CitaCancelada::class);

    }

    static public function crearCitaPaciente( Request $request){
        $data=$request->only([               
            'descripcion',
            'especialidad_id',
            'medico_id',
            'fecha_cita',
            'hora_cita',
            'tipo',
            'paciente_id',
        ]);
    
            /* $data['paciente_id']= $paciente_id; */
            //cambiar el formato  
            $hora_carbon=Carbon::createFromFormat('g:i A',$data['hora_cita']);
            $data['hora_cita']=$hora_carbon->format('H:i:s');

        return self::create($data);
    }
}

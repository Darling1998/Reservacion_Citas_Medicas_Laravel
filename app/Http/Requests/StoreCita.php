<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\HorarioServicioInterface;

use Carbon\Carbon;
class StoreCita extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private $horario_service;

    public function __construct(HorarioServicioInterface $horarioServicio)
    {
        $this->horario_service = $horarioServicio;
    }


    public function rules()
    {
        return [
            'descripcion'=>'required',
            'especialidad_id'=>'exists:especialidads,id',
            'medico_id'=>'exists:users,id',
            'hora_cita'=>'required',
            'paciente_id'=>'exists:users,id'
        ];
    }

    public function messages()
    {
      return[  'hora_cita.required'=>'Seleccione una hora válida'];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator)  {
            $fecha=$this->input('fecha_cita');
            $medico_id=$this->input('medico_id');
            $hora_cita=$this->input('hora_cita');

            if(!$fecha || !$medico_id || !$hora_cita){
                return;
            }
                
             $inicio = new Carbon($hora_cita);
            

            if(!$this->horario_service->disponibilidadIntervalo($fecha,$medico_id,$inicio)){
                $validator->errors()->add('Hora No Disponible','la hora seleccionida ya está reservada');
            }
        });
    }
}

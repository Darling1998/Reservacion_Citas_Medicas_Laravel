@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Cita # {{$cita->id}}</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <strong>Fecha: </strong>{{$cita->fecha_cita}}
                </li>
                <li>
                    <strong>Hora: </strong>{{$cita->hora_cita}}
                </li>
                @if ($role ==1)
                <li>
                    <strong>Medico: </strong>{{$cita->medico->name}}
                </li>
                @endif

                @if ($role ==1 || $role==2)
                <strong>Paciente: </strong>{{$cita->paciente->name}}
                @endif
                <li>
                    <strong>Especialidad: </strong>{{$cita->especialidad->nombre}}
                </li>
                <li>
                    <strong>Tipo</strong>{{$cita->tipo}}
                </li>
                <li>
                    <strong>Estado</strong>
                    @if ($cita->estado =='Cancelada')
                        <span class="badge badge-danger"> Cancelada</span>
                    @else
                        <span class="badge badge-danger"> {{$cita->estado}}</span>
                    @endif
                   
                </li>
                @if ($cita->cancelacion)
                    <li>
                        <strong>Motivo de cancelación: </strong>{{$cita->cancelacion->justificacion}}
                    </li>
                    <li>
                        <strong>Fecha de cancelación: </strong>{{$cita->cancelacion->created_at}}
                    </li>
                    
                    <li>
                        <strong>Cancelado por: </strong>
                        @if (auth()->id() == $cita->cancelacion->cancelado_por_id)
                            Cancelado por usted.                          
                        @else
                            {{$cita->cancelacion->cancelado_por->name}}
                        @endif
                    </li>
                @endif
            </ul> 
            <a href="{{url('/citas')}}" class="btn btn-default">
                Volver
            </a>
        </div>    
    </div>
@endsection

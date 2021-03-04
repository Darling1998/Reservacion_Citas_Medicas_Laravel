@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Cancelar citas</h3>
                </div>
            </div>
        </div>
{{--         <div class="card-body">
            @if (session('notificacion'))
            <div class="alert alert-success" role="alert">
                {{ session('notificacion') }}
            </div>

            <p>Cuentanos el motivo de la cancelación</p>
            <form action="{{url('citas/'.$cita->id.'/cancel')}}" method="POST">
                @csrf

                <div class="for-group">
                    <label for="justificacion"> Motivo de la cancelación</label>
                    <textarea id="justificacion" name ="justificacion" rows="3" class="form-control"></textarea>
                    
                </div>
                <button class="btn btn-sm btn-danger" type="submit" title="Cancelar cita"></button>
                <a href="{{url('/citas')}}" class="btn btn-primary">Volver al listado de citas</a>
            </form>
             @endif
        </div>  --}}   


        <div class="card-body">
            @if (session('notificacion'))
            <div class="alert alert-success" role="alert">
              {{ session('notificacion') }}
            </div>
            @endif
      

            @if ($role==1)
            <p>
              Estás a punto de cancelar la cita reservada 
              por el paciente {{ $cita->paciente->name }}  {{ $cita->paciente->apellido }}  
              para ser atendido por el médico {{ $cita->medico->name }} {{ $cita->medico->apellido }}
              (especialidad {{ $cita->especialidad->nombre }}) 
              el día {{ $cita->fecha_cita }}
              (hora {{ $cita->hora_cita }}):
            </p>
            @endif

            @if ($role==2)
            <p>
              Estás a punto de cancelar tu cita con el paciente 
              {{ $cita->paciente->name }} 
              (especialidad {{ $cita->especialidad->nombre }}) 
              para el día {{ $cita->fecha_cita }}
              (hora {{ $cita->hora_cita }}):
            </p>
  
            @endif


            <form action="{{ url('/citas/'.$cita->id.'/cancelar') }}" method="POST">
              @csrf
      
              <div class="form-group">
                <label for="justificacion">Por favor cuéntanos el motivo de la cancelación:</label>
                <textarea required id="justificacion" name="justificacion" rows="3" class="form-control"></textarea>
              </div>        
      
              <button class="btn btn-danger" type="submit">Cancelar cita</button>
              <a href="{{ url('/citas') }}" class="btn btn-default">
                Volver al listado de citas sin cancelar
              </a>
            </form>
          </div>    
      
    </div>
@endsection

<div class="table-responsive">
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Descripción</th>
          <th scope="col">Especialidad</th>
          @if ($role == 2)
            <th scope="col">Paciente</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Tipo</th>
            <th scope="col">Opciones</th>
           @endif 
        </tr>
      </thead>
      <tbody>
        @foreach ($citasPendientes as $cita)
        <tr>
          <th scope="row">
            {{ $cita->descripcion }}
          </th>
          <td>
            {{ $cita->especialidad->nombre }}
          </td>
          {{-- @if ($role_id == 'patient') --}}
            <td>{{ $cita->medico->name }}</td>
          {{-- @elseif ($role_id == 'doctor') --}}
            <td>{{ $cita->paciente->name }}</td>
          {{-- @endif --}}
          <td>
            {{ $cita->fecha_cita }}
          </td>
          <td>
            {{ $cita->hora_cita }}
          </td>
          <td>
            {{ $cita->tipo }}
          </td>
          <td>
            @if ($role == 1) 
              <a class="btn btn-sm btn-primary" title="Ver cita" 
                href="{{ url('/citas/'.$cita->id) }}">
                  Ver
              </a> 
            @endif 
            @if ($role == 1 || $role == 2) 
              <form action="{{ url('/citas/'.$cita->id.'/confirmar') }}"
                method="POST" class="d-inline-block">
                @csrf
                <button class="btn btn-sm btn-success" type="submit" 
                  data-toggle="tooltip" title="Confirmar cita">
                  <i class="ni ni-check-bold"></i>
                </button>
              </form>
            @endif    
            
            <form action="{{ url('/citas/'.$cita->id.'/cancelar') }}" 
              method="POST" class="d-inline-block">
              @csrf
  
              <button class="btn btn-sm btn-danger" type="submit" 
                data-toggle="tooltip" title="Cancelar cita">
                <i class="ni ni-fat-delete"></i>
              </button>
            </form>  
            
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
  
  <div class="card-body">
    {{-- {{ $pendingcitas->links() }} --}}
  </div>
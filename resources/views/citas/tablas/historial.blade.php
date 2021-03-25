<div class="table-responsive">
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Especialidad</th>
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
             @if ($role == 1 || $role == 2)
            <th scope="col">Estado</th>
            @endif
            <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
         @foreach ($citasViejas as $cita)
        <tr>
          <td>
            {{ $cita->especialidad->nombre }}
          </td>
          <td>
            {{ $cita->fecha_cita }}
          </td>
          <td>
            {{ $cita->hora_cita }}
          </td>
          <td>
            {{ $cita->estado }}
          </td>
          <td>
           {{--  @if ($role_id == 1) --}}
              <a class="btn btn-sm btn-primary" title="Ver cita" 
                href="{{ url('/citas/'.$cita->id) }}">
                  Ver
              </a>
           {{--  @endif --}}
{{--             <a class="btn btn-sm btn-danger" title="Cancelar cita" 
              href="{{ url('/citas/'.$cita->id.'/cancel') }}">
                Cancelar --}}
           {{-- // </a> --}}
          </td>
        </tr>
        @endforeach 
      </tbody>
    </table>
  </div>
  
  <div class="card-body">
    {{-- {{ $confirmedcitas->links() }} --}}
  </div>
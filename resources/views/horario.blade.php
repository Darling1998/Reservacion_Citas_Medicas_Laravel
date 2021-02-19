@extends('layouts.panel')

@section('content')
<form action="{{url('horario')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Gestionar Horario</h3>
                </div>
                <div class="col text-right">
                    <button type="submit" class="btn btn-sm btn-success">Guardar cambios</button>
                </div>
            </div>
        </div>
        
      <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Día</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Turno mañana</th>
                        <th scope="col">Turno tarde[]</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($dias as $aux=> $dia)
                    <tr>
                        <th> {{$dia}}</th>
                        <td>
                            <label class="custom-toggle">
                                <input type="checkbox" name="activo[]" value="{{$aux}}">
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="hora_inicio_mñn[]">
                                        @for($i=6;$i<=11;$i++)
                                        <option value="{{$i}}:00">{{$i}}:00 am</option>
                                        <option value="{{$i}}:30">{{$i}}:30 am</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="hora_fin_mñn[]">
                                        @for($i=6;$i<=11;$i++)
                                        <option value="{{$i}}:00">{{$i}}:00 am</option>
                                        <option value="{{$i}}:30">{{$i}}:30 am</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="hora_inicio_tarde[]">
                                        @for($i=1;$i<=8;$i++)
                                        <option value="{{$i+12}}:00">{{$i+12}}:00 pm</option>
                                        <option value="{{$i+12}}:30">{{$i+12}}:30 pm</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="hora_fin_tarde[]">
                                        @for($i=1;$i<=8;$i++)
                                        <option value="{{$i+12}}:00">{{$i+12}}:00 pm</option>
                                        <option value="{{$i+12}}:30">{{$i+12}}:30 pm</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>
                        </td>
                        
                        <td></td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
       </div>  
    </div>
</form>


@endsection

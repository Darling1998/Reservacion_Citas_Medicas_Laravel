@extends('layouts.panel')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Especialidades</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('especialidades/crear')}}" class="btn btn-sm btn-primary">Agregar Especialidad</a>
                </div>
            </div>
        </div>

       <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach( $especialidades as $especialidad)
                    <tr>
                        <th scope="row">
                            {{$especialidad->nombre}}
                        </th>
                        <td>
                            {{$especialidad->descripcion}}
                        </td>
                        <td>
                            
                            <form action="{{url('/especialidades/'.$especialidad->id)}}" method="POST">
                                @csrf
                                @method('DELETE')                            
                                <a href="{{url('especialidades/'.$especialidad->id.'/editar')}}" class="btn btn-sm btn-success">Editar</a>
                            <button href="" class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
       </div> 
    </div>

@endsection

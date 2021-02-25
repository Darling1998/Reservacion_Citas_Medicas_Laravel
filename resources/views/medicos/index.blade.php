@extends('layouts.panel')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Médicos</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('medicos/create')}}" class="btn btn-sm btn-primary">Agregar médico</a>
                </div>
            </div>
        </div>

       <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Cédula</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach( $medicos as $medico)
                    <tr>
                        <th scope="row">
                            {{$medico->name}}
                        </th>
                        <th scope="row">
                            {{$medico->apellido}}
                        </th>
                        <td>
                            {{$medico->cedula}}
                        </td>
                        <td>
                            {{$medico->email}}
                        </td>
                        <td>
                            
                            <form action="{{url('/medicos/'.$medico->id)}}" method="POST">
                                @csrf
                                @method('DELETE')                            
                                <a href="{{url('/medicos/'.$medico->id.'/edit')}}" class="btn btn-sm btn-success">Editar</a>
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

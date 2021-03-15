@extends('layouts.panel')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Pacientes</h3>
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
                        <th scope="col">Email</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach( $pacientes as $paciente)
                    <tr>
                        <th scope="row">
                            {{$paciente->name}}
                        </th>
                        <td>
                            {{$paciente->apellido}}
                        </td>
                        <th scope="row">
                            {{$paciente->email}}
                        </th>

                        <td>
 {{--                            
                            <form action="{{url('/pacientes/'.$paciente->id)}}" method="POST">
                                @csrf
                                @method('DELETE')                            
                                <a href="{{url('pacientes/'.$paciente->id.'/editar')}}" class="btn btn-sm btn-success">Editar</a>
                            <button href="" class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
       </div> 
    </div>

@endsection

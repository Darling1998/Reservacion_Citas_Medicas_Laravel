@extends('layouts.panel')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reporte de Cuadro de Estados de Citas</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('/reportes/tabla/citas/pdf')}}" class="btn btn-sm btn-primary">Imprimir</a>
                </div>
            </div>
        </div>

       <div class="table-rnponsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Epecialidad</th>
                        <th scope="col">Citas Atendidas</th>
                        <th scope="col">Citas Canceladas</th>
                        <th scope="col">Citas Totales</th>
                    </tr>
                    
                </thead>

                <tbody>
                    @foreach( $nomAp as $np)
                    <tr>
                       
                        <th scope="row">
                            {{$np->name}}
                        </th>
                        <th scope="row">
                            {{$np->apellido}}
                        </th>
                        
                        <td>
                            {{$np->nombre}}
                        </td>
                        <td>
                            100
                        </td>
                        <td>
                           150
                        </td>
                        <td>
                            250
                         </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
       </div> 
    </div>

@endsection

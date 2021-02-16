@extends('layouts.panel')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo médico</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('medicos')}}" class="btn btn-sm btn-primary">Cancelar</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if( $errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{url('médicos')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required value="{{ old('nombre')}}"></input>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="{{ old('apellido')}}"></input>
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ old('cedula')}}"></input>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono')}}"></input>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email')}}"></input>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>  
        </div>

    </div>

@endsection

@extends('layouts.panel')

@section('content')
<div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar médico</h3>
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
            <form action="{{url('medicos/'.$medico->id)}}" method="POST">
                @csrf
                @method('PUT')
                <h6 class="heading-small text-muted mb-4">Informacion de usuario</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="name">Nombre</label>
                        <input type="text"  class="form-control" name="name" required value="{{ old('name',$medico->name)}}"  >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email',$medico->email)}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="apellido">Apellido</label>
                        <input type="text" name="apellido" class="form-control" required  value="{{ old('apellido',$medico->apellido)}}" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="last-name">Contraseña </label>
                        <input type="password" name="password"  class="form-control" >
                        <p>Modifica este campo si quieres cambiar la contraseña</p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="last-name">Cédula</label>
                        <input type="text" name="cedula"  class="form-control" required  value="{{ old('cedula',$medico->cedula)}}">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">

                <h6 class="heading-small text-muted mb-4">Información de Contacto</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="telefono">Teléfono</label>
                        <input name="telefono" class="form-control"   type="text" value="{{ old('telefono',$medico->telefono)}}">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <button type="submit" class="btn btn-success">Guardar</button>
              </form> 
              
        </div>

    </div>
@endsection

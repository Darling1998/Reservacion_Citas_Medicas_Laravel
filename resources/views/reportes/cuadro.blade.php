@extends('layouts.panel')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reporte Control de Citas</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('/reportes/tabla/citas/pdf')}}" class="btn btn-sm btn-primary">Imprimir</a>
                </div>
            </div>

            <br>
            <form action="/reportes/tabla/citas/all" method="POST" id="form1">
                @csrf

            
            <div class="form-row">
                <div style="padding-right: 50px; padding-left: 50px;">
                    <label for="validationTooltip02"></label>
                    <div class="input-group">
                    <select class="custom-select" required  id="especialidad">
                        @foreach ($especialidades as $item)
                            <option value="{{$item->id}}" name="{{$item->id}}">{{$item->nombre}}</option>
                         @endforeach
                      </select>
                    </div>
                </div>

                <div class="input-daterange datepicker row align-items-center" data-date-format="yyyy-mm-dd">
                    <div class="col">
                        <label for="validationTooltip02"></label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input name="dia_inicio" class="form-control" placeholder="Fecha Inicio" type="text" value="{{$inicio}}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="validationTooltip02"></label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input name="dia_fin" class="form-control" placeholder="Fecha Fin" type="text" value="{{$fin}}">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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
                        <th scope="col">Citas Totales</th>
                    </tr>
                    
                </thead>

                <tbody id="tablabody">
                   
                </tbody>
            </table>
       </div>  
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        let $idEsp,$inicio,$fin;
/*         $('#especialidad').on('change',function(e){
            console.log(e.target.value)
        }) */

        function limpiar(){
            $("#tablabody").empty();
            fetchData();
        }
         function fetchData(){
            const espeId=$idEsp.val();
            const inicioFecha = $inicio.val();
            const finFecha = $fin.val();

            $(document).ready(function(){
                $.ajax({
                    url:'/reportes/tabla/citas/all',
                    method:'POST',
                    data: {
                        select:espeId,
                        id:1,
                        _token: $('input[name="_token"]').val(),
                        inicio:$('input[name="dia_inicio"]').val() ,
                        fin:$('input[name="dia_fin"]').val(),
                      
                    } 

                }).done(function(res){
                    var arreglo = JSON.parse(res);
                    console.log(arreglo);
                     
                    for (var i=0; i<arreglo.length;i++){
                        var todo='<tr><th>'+arreglo[i].name+'</th>';
                            todo+='<th>'+arreglo[i].apellido+'</th>';
                            todo+='<th>'+arreglo[i].nombre+'</th>';
                            todo+='<th>'+arreglo[i].total+'</th></tr>';
                        $('#tablabody').append(todo);
                        //console.log(todo)
                    } 

                });
            });
        }   

        $(function () {
            
        $inicio = $('#dia_inicio');
        $fin = $('#dia_fin');
        $idEsp=$('#especialidad')

        fetchData();
 
        $inicio.change(limpiar);
        $fin.change(limpiar);
         $idEsp.change(limpiar);
    }); 
    </script>
@endsection

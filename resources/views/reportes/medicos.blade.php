@extends('layouts.panel')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reporte Médicos más Solicitados</h3>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="input-daterange datepicker row align-items-center" data-date-format="yyyy-mm-dd">
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input id="dia_inicio" class="form-control" placeholder="Fecha Inicio" type="text" value="{{$inicio}}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input id="dia_fin" class="form-control" placeholder="Fecha Fin" type="text" value="{{$fin}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="container">
                
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        const report=Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Médicos más Activos'
            },
            xAxis: {
                categories: [],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                text: 'Citas Atendidas'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                pointPadding: 0.2,
                borderWidth: 0
                }
            },
            series: []
        });


    let $inicio, $fin;



    function fetchData() {
        const inicioFecha = $inicio.val();
        const finFecha = $fin.val();

        // Fetch API
        const url = `/reportes/medicos/barras/infor?inicio=${inicioFecha}&fin=${finFecha}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
            // console.log(data);
            report.xAxis[0].setCategories(data.categorias);

            if (report.series.length > 0) {
                report.series[1].remove();            
                report.series[0].remove();
            }
            
            report.addSeries(data.series[0]); 
            report.addSeries(data.series[1]); 
            });
    }

    $(function () {
        $inicio = $('#dia_inicio');
        $fin = $('#dia_fin');

        fetchData();
        
        $inicio.change(fetchData);
        $fin.change(fetchData);
    });

    </script>
@endsection
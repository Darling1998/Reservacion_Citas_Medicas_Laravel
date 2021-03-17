@extends('layouts.panel')

@section('content')
    <div class="card">
        
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reporte Frecuencia de Citas</h3>
                </div>
            </div>

        <div class="card-body">
            <div id="container">

            </div>
        </div>
    
    </div>

@endsection

@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.chart('container', {

        title: {
            text: 'Citas registradas mensualmente'
        },
        yAxis: {
            title: {
                text: 'Número de citas'
            }
        },

        xAxis: {
            categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
           
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                
            }
        },

        series: [{
            name: 'Citas registradas',
            data: @JSON($cantidades)
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

        });

    </script>
@endsection
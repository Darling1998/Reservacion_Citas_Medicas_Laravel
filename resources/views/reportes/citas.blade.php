@extends('layouts.panel')

@section('content')
    <div class="card">
        
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Reporte Frecuencia de Citas</h3>
                </div>
            </div>

{{--             <div class="col-xl-8">
                <div class="card bg-default">
                  <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                      <div class="col">
                        <h6 class="text-light text-uppercase ls-1 mb-1"></h6>
                        <h5 class="h3 text-white mb-0"></h5>
                      </div>
                      <div class="col">
                        <ul class="nav nav-pills justify-content-end">
                          <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update="{&quot;data&quot;:{&quot;datasets&quot;:[{&quot;data&quot;:[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}" data-prefix="$" data-suffix="k">
                            <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                              <span class="d-none d-md-block">2020</span>
                              <span class="d-md-none">M</span>
                            </a>
                          </li>
                          <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark" data-update="{&quot;data&quot;:{&quot;datasets&quot;:[{&quot;data&quot;:[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}" data-prefix="$" data-suffix="k">
                            <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                              <span class="d-none d-md-block">2021</span>
                              <span class="d-md-none">W</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Chart -->
                    <div id="container">

                    </div>
                  </div>
                </div>
              </div> --}}

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
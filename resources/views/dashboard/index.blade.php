@extends('layouts.main')

@section('title')
Dashboard
@endsection

@push('style')
<style>
</style>
@endpush

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                {{-- <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Starter Page</li>
                 </ol> --}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                {{-- <div class="small-box bg-info">
                    <div class="inner">
                        <p>Penjualan Hari Ini</p>
                        <h3>@currency($total_penjualan_day)</h3>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    
                </div> --}}
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                {{-- <div class="small-box bg-success">
                    <div class="inner">
                        <p>Penjualan Bulan Ini</p>
                        <h3>@currency($total_penjualan_month)</h3>

                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    
                </div> --}}
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->

            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                {{-- <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div> --}}
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
                {{-- <div class="card">
                    <div class="card-header">

                        <div class="card-tools">

                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="chart_pemakaian_rt" style="position: relative;">

                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div> --}}
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-1"></i>
                            GODONGJATI PERBULAN
                        </h3>

                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="chart tab-pane active" id="chart_pemakaian_rt" style="position: relative;">
                            <canvas id="myChart1"></canvas>

                        </div>
                    </div><!-- /.card-body -->
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1"></i>
                            OMZET PER HARI
                        </h3>

                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="chart tab-pane active" id="chart_pemakaian_rt" style="position: relative;">
                            <canvas id="myChart2"></canvas>

                        </div>
                    </div><!-- /.card-body -->
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-1"></i>
                            OMZET PER BULAN
                        </h3>

                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="chart tab-pane active" id="chart_pemakaian_rt" style="position: relative;">
                            <canvas id="myChart3"></canvas>

                        </div>
                    </div><!-- /.card-body -->
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-1"></i>
                            CUCI BY QTY
                        </h3>

                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="chart tab-pane active" id="chart_pemakaian_rt" style="position: relative;">
                            <canvas id="myChart4"></canvas>

                        </div>
                    </div><!-- /.card-body -->
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-1"></i>
                            TOTAL OMZET CUCI
                        </h3>

                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="chart tab-pane active" id="chart_pemakaian_rt" style="position: relative;">
                            <canvas id="myChart5"></canvas>

                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- DIRECT CHAT -->

                <!--/.direct-chat -->

                <!-- TO DO List -->

                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">

                <!-- Map card -->
                {{-- <div class="card">
                    <div class="card-header">

                        <div class="card-tools">

                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="chart_pemakaian_rt" style="position: relative;">

                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div> --}}
                <!-- /.card -->

                <!-- solid sales graph -->

                <!-- /.card -->

                <!-- Calendar -->

                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('script')
<script>
    var ctx1 = document.getElementById('myChart1').getContext('2d');

    var chart1 = new Chart(ctx1, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  {!!json_encode($chart_byMonth->labels)!!} ,
            datasets: [
                {
                    label: 'OMZET PER BULAN',
                    data:  {!! json_encode($chart_byMonth->dataset)!!} ,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "arial",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });

     //chart 2
    var ctx2 = document.getElementById('myChart2').getContext('2d');
     var chart2 = new Chart(ctx2, {
        // The type of chart we want to create
        type: 'line',
// The data for our dataset
        data: {
            labels:  {!!json_encode($chart_byDay->labels)!!} ,
            datasets: [
                {
                    label: 'OMZET PER HARI',
                    data:  {!! json_encode($chart_byDay->dataset)!!} ,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgb(255, 159, 64)',
                    
                },
            ]
        },
// Configuration options go here
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "arial",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });

    //chart 3
    var ctx3 = document.getElementById('myChart3').getContext('2d');
    var chart3 = new Chart(ctx3, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  {!!json_encode($chart_byRekanan->labels)!!} ,
            datasets: [
                {
                    label: 'OMZET PER PER BULAN',
                    data:  {!! json_encode($chart_byRekanan->dataset)!!} ,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    
                },
            ]
        },
// Configuration options go here
        options: {
            indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "arial",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });

    //chart 4
    var ctx4 = document.getElementById('myChart4').getContext('2d');
    var chart4 = new Chart(ctx4, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  {!!json_encode($chart_bycuciTotal->labels)!!} ,
            datasets: [
                {
                    label: 'CUCI BY QTY',
                    data:  {!! json_encode($chart_bycuciTotal->dataset)!!} ,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgb(153, 102, 255)',
                    
                },
            ]
        },
// Configuration options go here
        options: {
            //indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "arial",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });

    //chart 5
    var ctx5 = document.getElementById('myChart5').getContext('2d');
     var chart5 = new Chart(ctx5, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  {!!json_encode($chart_omzetcuciTotal->labels)!!} ,
            datasets: [
                {
                    label: 'TOTAL OMZET CUCI',
                    data:  {!! json_encode($chart_omzetcuciTotal->dataset)!!} ,
                },
            ]
        },
// Configuration options go here
        options: {
            indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "arial",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>
@endpush

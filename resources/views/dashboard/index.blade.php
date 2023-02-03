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
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Penjualan Hari Ini</p>
                        <h3>@currency($total_penjualan_day)</h3>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <p>Penjualan Bulan Ini</p>
                        <h3>@currency($total_penjualan_month)</h3>

                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
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
                {{-- <div class="card">
                     <div class="card-header">
                         <h3 class="card-title">
                             <i class="fas fa-chart-pie mr-1"></i>
                             Chart Pemakaian
                         </h3>
                         <div class="card-tools">
                             <ul class="nav nav-pills ml-auto">
                                 <li class="nav-item">
                                     <a class="nav-link active" href="#chart_pemakaian_rt" data-toggle="tab">Chart
                                         Pemakaian RT</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="#chart_pemakaian_kelas" data-toggle="tab">Chart Pemakaian
                                         Kelas</a>
                                 </li>
                             </ul>
                         </div>
                     </div><!-- /.card-header -->
                     <div class="card-body">
                         <div class="tab-content p-0">
                             <!-- Morris chart - Sales -->
                             <div class="chart tab-pane active" id="chart_pemakaian_rt" style="position: relative;">
                                 <canvas id="chart_pemakaian_rt_canvas" height="400" style="height: 400px;"></canvas>
                             </div>
                             <div class="chart tab-pane" id="chart_pemakaian_kelas" style="position: relative;">
                                 <canvas id="chart_pemakaian_kelas_canvas" height="400" style="height: 400px;"></canvas>
                             </div>
                         </div>
                     </div><!-- /.card-body -->
                 </div> --}}
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

</script>
@endpush

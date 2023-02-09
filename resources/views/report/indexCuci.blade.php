@extends('layouts.main')

@section('title')
Report
@endsection

@push('styles')
<style>
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">


                <div class="card card-primary card-outline">
                    <div class="card-body">
                        {{-- <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#modaltambahdata"><i class="fas fa-plus-circle"></i>Tambah</a><br><br> --}}

                        <form action="/report/cuci/print" method="post">
                            @csrf
                            <table border="0" cellspacing="5" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="min" name="min" value="<?php echo date('d-m-Y'); ?>">
                                        </td>
                                        <td>-</td>
                                        <td>
                                            <input type="text" id="max" name="max" value="<?php echo date('d-m-Y'); ?>">
                                        </td>
                                        <td>
                                            <button type="button" onclick="filter()" class="btn btn-success btn-xs">Filter</button>
                                            <button class="btn btn-primary btn-xs">Report</button>
                                            {{-- <a href="/report/pelanggan/print" class="btn btn-primary btn-xs">Report</a> --}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                        <table id="dt-basic-example" class="table table-bordered table-responsive table-hover" style="width: 100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Pelanggan</th>
                                    {{-- <th>Barang</th> --}}
                                    <th>Total Motor</th>
                                    <th>Total Mobil</th>
                                    <th>Gratis Cuci Motor</th>
                                    <th>Gratis Cuci Mobil</th>
                                    <th>Grand Total Motor</th>
                                    <th>Grand Total Mobil</th>
                                </tr>
                            </thead>
                        </table>

                    </div><!-- /.card -->
                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    @endsection

    @push('script')
    <script>
        $(document).ready(function() {
            // // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'DD-MM-YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'DD-MM-YYYY'
            });

            table.draw();
        });

        var table = $('#dt-basic-example').DataTable({
            "destroy": true
            , "processing": true
            , "serverSide": true
            , "paging": false
            , "info": false
            , "ajax": {
                "url": "/report/data"
                , "dataType": "json"
                , "type": "POST"
                , "data": function(d) {
                    d.min = $('#min').val();
                    d.max = $('#max').val();
                }
            , }
            , "columns": [{
                    "data": "nama_pelanggan"
                }
                , {
                    "data": "cuci_motor"
                }
                , {
                    "data": "cuci_mobil"
                }
                , {
                    "data": "gratis_cuci_motor"
                }
                , {
                    "data": "gratis_cuci_mobil"
                }
                , {
                    "data": "total_motor"
                }
                , {
                    "data": "total_mobil"
                }
            , ],
            // "columns": [{
            //         "data": "nama_pelanggan"
            //     },
            //     {
            //         "data": "nama_barang"
            //     },
            //     {
            //         "data": "jumlah_motor"
            //     },
            //     {
            //         "data": "jumlah_mobil"
            //     },
            //     {
            //         "data": "gratis_cuci_motor"
            //     },
            //     {
            //         "data": "gratis_cuci_mobil"
            //     },
            // ],
        });

        function filter() {
            console.log('Filter');
            table.draw();
        }

    </script>
    @endpush

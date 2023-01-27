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

                            <form action="/report/print" method="post">
                                @csrf
                                <table border="0" cellspacing="5" cellpadding="5">
                                    <tbody>
                                        <tr>
                                            {{-- <td>
                                                <input type="text" id="min" name="min"
                                                       value="<?php echo date('d-m-Y'); ?>">
                                            </td>
                                            <td>-</td>
                                            <td>
                                                <input type="text" id="max" name="max"
                                                       value="<?php echo date('d-m-Y'); ?>">
                                            </td> --}}
                                            <td>
                                                <a href="/report/pelanggan/print" class="btn btn-primary btn-xs">Report</a>
                                                {{-- <button type="submit" class="btn btn-primary">Print</button> --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>

                            <table id="dt-basic-example" class="table table-bordered table-responsive table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Pelanggan</th>
                                        <th>Barang</th>
                                        <th>Total Motor</th>
                                        <th>Total Mobil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPelanggan as $pelanggan)
                                        <tr>
                                            {{-- <td rowspan="{{ count($dataBarang->toArray()) + 1 }}">{{ $pelanggan->nama_pelanggan }}</td> --}}
                                            <td
                                                rowspan="{{ count($pelanggan->jumlahType()) ? count($pelanggan->jumlahType()) + 1 : 2 }}">
                                                {{ $pelanggan->nama_pelanggan }}</td>
                                        </tr>
                                        @php
                                            $jumlahCuci = 0;
                                        @endphp
                                        @foreach ($dataBarang as $barang)
                                            @if ($barang->jumlah($pelanggan->id_pelanggan))
                                                @php
                                                    $type = explode(' ', $barang->nama_barang);
                                                    $jumlahCuci++;
                                                @endphp
                                                <tr>
                                                    <td>{{ $barang->nama_barang }}</td>
                                                    <td>{{ $type[1] == 'motor' ? $barang->jumlah($pelanggan->id_pelanggan) : 0 }}
                                                    </td>
                                                    <td>{{ $type[1] == 'mobil' ? $barang->jumlah($pelanggan->id_pelanggan) : 0 }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        @if ($jumlahCuci == 0)
                                            <tr>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
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
            // var minDate, maxDate;
            // Custom filtering function which will search data in column four between two values
            // $.fn.dataTable.ext.search.push(
            //     function(settings, data, dataIndex) {
            //         var min = minDate.val();
            //         var max = maxDate.val();
            //         var date = new Date(data[5]);
            //         if (
            //             (min === null && max === null) ||
            //             (min === null && date <= max) ||
            //             (min <= date && max === null) ||
            //             (min <= date && date <= max)
            //         ) {
            //             return true;
            //         }
            //         return false;
            //     }
            // );
            $(document).ready(function() {
                // // Create date inputs
                // minDate = new DateTime($('#min'), {
                //     format: 'DD-MM-YYYY'
                // });
                // maxDate = new DateTime($('#max'), {
                //     format: 'DD-MM-YYYY'
                // });
                var table = $('#dt-basic-example').DataTable({
                    // initComplete: function() {
                    //     this.api()
                    //         .columns()
                    //         .every(function() {
                    //             var column = this;
                    //             var select = $('<select><option value=""></option></select>')
                    //                 .appendTo($(column.footer()).empty())
                    //                 .on('change', function() {
                    //                     var val = $.fn.dataTable.util.escapeRegex($(this)
                    //                         .val());
                    //                     column.search(val ? '^' + val + '$' : '', true, false)
                    //                         .draw();
                    //                 });
                    //             column
                    //                 .data()
                    //                 .unique()
                    //                 .sort()
                    //                 .each(function(d, j) {
                    //                     select.append('<option value="' + d + '">' + d +
                    //                         '</option>');
                    //                 });
                    //         });
                    // },
                });
            });
        </script>
    @endpush

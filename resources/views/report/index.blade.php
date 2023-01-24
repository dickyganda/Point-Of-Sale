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

                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td><input type="text" id="min" name="min" value="<?php echo date('d-m-Y'); ?>">
                                    </td>
                                    <td>-</td>
                                    <td><input type="text" id="max" name="max" value="<?php echo date('d-m-Y'); ?>">
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Rekanan</th>
                                    <th>Nama Barang</th>
                                    <th>Qty Penjualan</th>
                                    <th>Price</th>
                                    <th>Tgl_penjualan</th>
                                    <th>Grand Total</th>

                                </tr>
                            </thead>
                            <tbody height="10px">
                                @php $i=1 @endphp
                                @foreach($report_all as $report)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $report->nama_rekanan }}</td>
                                    <td>{{ $report->nama_barang }}</td>
                                    <td>{{ $report->qty_penjualan }}</td>
                                    <td>{{ $report->harga_barang }}</td>
                                    <td>{{ $report->tgl_transaksi_penjualan }}</td>
                                    <td>{{ $report->total_penjualan }}</td>
                                    {{-- <td>

                                        <a href="/transaksicuci/edittransaksicuci/{{ $cuci->id_cuci }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a>
                                    <a href="#" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-print"></i></a>

                                    <a href="#" onclick="deleteharga({{$harga->id_harga}})" title="Hapus" class="btn btn-danger btn-xs" role="button"><i class="fas fa-trash"></i></a>

                                    </td> --}}
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Rekanan</th>
                                    <th>Nama Barang</th>
                                    <th>Qty Penjualan</th>
                                    <th>Price</th>
                                    <th>Tgl_penjualan</th>
                                    <th>Grand Total</th>
                                </tr>
                                <tr>
                                    <td colspan="6"> Grand Total</td>
                                    <td>{{$grand_total}}</td>
                                </tr>
                            </tfoot>
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
        var minDate, maxDate;
        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[5]);
                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'DD-MM-YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'DD-MM-YYYY'
            });
            var table = $('#dt-basic-example').DataTable({
                dom: 'Bfrtip'
                , buttons: [
                    'excel', 
                    , {
                        extend: 'pdfHtml5'
                        , orientation: 'landscape'
                        , pageSize: 'A4'
                    }
                , ]
                , initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this)
                                        .val());
                                    column.search(val ? '^' + val + '$' : '', true
                                        , false).draw();
                                });
                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d +
                                        '</option>');
                                });
                        });
                }
            , });
            // Refilter the table
            $('#min, #max').on('change', function() {
                table.draw();
            });
        });

        $("#tambahkas").submit(function(event) {
            event.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                type: 'POST'
                , dataType: 'json'
                , url: '/transaksikas/tambahkas'
                , data: formdata
                , contentType: false
                , cache: false
                , processData: false
                , success: function(data) {
                    Swal.fire(
                        'Sukses!'
                        , data.reason
                        , 'success'
                    ).then(() => {
                        location.replace("/transaksikas/index");
                    });
                }
            });
        });

        function deleteharga(id_harga) {
            Swal.fire({
                title: 'Hapus Data ?'
                , text: "Anda tidak akan dapat mengembalikan ini!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET'
                        , dataType: 'json'
                        , url: '/dataharga/deleteharga/' + id_harga
                        , success: function(data) {
                            Swal.fire(
                                'Sukses!'
                                , data.reason
                                , 'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        }

        $(document).ready(function() {
            $('#rt').select2({
                placeholder: "Pilih RT"

            });
        });

        $(document).ready(function() {
            $('#status_pelanggan').select2({
                placeholder: "Pilih Status"
            });
        });

    </script>
    @endpush

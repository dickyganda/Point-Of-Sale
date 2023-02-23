@inject('carbon', 'Carbon\Carbon')
@extends('layouts.main')

@section('title')
Data Transaksi Kas
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
                <h1 class="m-0">Data Transaksi Kas</h1>
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
                        <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#modaltambahdata"><i class="fas fa-plus-circle"></i></a><br><br>
                        {{-- <h4>Total Saldo Kas : @currency($dataSaldo->debit - $dataSaldo->kredit)</h4> --}}

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
                                    <th>Description</th>
                                    <th>Partner</th>
                                    <th>Date</th>
                                    <th>Debit</th>
                                    <th>kredit</th>
                                    <th>Saldo</th>
                                    {{-- <th>Aksi</th> --}}

                                </tr>
                            </thead>
                            <tbody height="10px">
                                @php $i=1 @endphp
                                @foreach ($t_kas as $kas)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $kas->keterangan }}</td>
                                    @if(!empty($kas->nama_rekanan))
                                    <td>{{ $kas->nama_rekanan }}</td>
                                    @else
                                    <td>Lainnya</td>
                                    @endif
                                    {{-- <td>{{ $kas->nama_rekanan }}</td> --}}
                                    <td>{{ $carbon::parse($kas->tgl_kas)->format('Y-m-d') }}</td>
                                    <td align="right">@currency($kas->debit)</td>
                                    <td align="right">@currency($kas->kredit)</td>
                                    <td align="right">@currency(intval($kas->saldo_kas))</td>
                                    {{-- <td>

                                        <a href="/dataharga/editharga/{{ $harga->id_harga }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a>

                                    <a href="#" onclick="deletekas({{ $kas->id_kas }})" title="Hapus" class="btn btn-danger btn-xs" role="button"><i class="fas fa-trash"></i></a>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">Total Saldo</td>
                                    <td>@currency($dataSaldo->debit - $dataSaldo->kredit)</td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>

                    {{-- Modal Tambah Data --}}
                    <div class="modal fade" id="modaltambahdata">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Transaksi Kas</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form id="tambahkas" method="post">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <select id="id_rekanan" name="id_rekanan" class="form-control form-control-sm select2" style="width:100%;">
                                                <option></option>
                                                @foreach ($datarekanan as $rekanan)
                                                <option value="{{ $rekanan->id_rekanan }}">
                                                    {{ $rekanan->nama_rekanan }}</option>
                                                @endforeach
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select id="debit_kredit" name="type" class="form-control form-control-sm select2" style="width:100%;" required>
                                                <option></option>
                                                <option value="1">Debit</option>
                                                <option value="0">Kredit</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="number" name="jumlah" class="form-control form-control-sm" placeholder="Jumlah Rupiah">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Keterangan">
                                        </div>

                                        <br>
                                        <button class="btn btn-primary btn-xs" type="submit">Tambah</button>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
                                </div>

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
                        var date = new Date(data[3]);
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
                        initComplete: function() {
                            this.api()
                                .columns()
                                .every(function() {

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
                                'Sukses!', data.reason, 'success'
                            ).then(() => {
                                location.replace("/transaksikas/index");
                            });
                        }
                    });
                });

                function deletekas(id_harga) {
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
                                , url: '/transaksikas/deletekas/' + id_harga
                                , success: function(data) {
                                    Swal.fire(
                                        'Sukses!', data.reason, 'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    })
                }

                $(document).ready(function() {
                    $('#id_rekanan').select2({
                        placeholder: "Pilih Rekanan"

                    });

                    $('#debit_kredit').select2({
                        placeholder: "Pilih Jenis Kas"

                    });
                });

            </script>
            @endpush

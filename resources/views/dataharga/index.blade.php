@extends('layouts.main')

@section('title')
Data Master Harga
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
                <h1 class="m-0">Data Master Harga</h1>
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
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">


                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td><input type="text" id="min" name="min" value="<?php echo date('d-m-Y');?>">
                                    </td>
                                    <td>-</td>
                                    <td><input type="text" id="max" name="max" value="<?php echo date('d-m-Y');?>"></td>
                                </tr>
                                {{-- <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#modaltambahdata"><i class="fas fa-plus-circle"></i></a><br><br> --}}

                                <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Partner</th>
                                            <th>Update</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody height="10px">
                                        @php $i=1 @endphp
                                        @foreach($dataharga as $harga)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $harga->nama_barang }}</td>
                                            <td align="right"> @currency($harga->harga_satuan)</td>
                                            @if($harga->status_harga == '1')
                                            <td><span class="badge badge-success">Aktif</span></td>
                                            @else
                                            <td><span class="badge badge-danger">Tidak Aktif</span></td>
                                            @endif
                                            {{-- <td>{{ $jumlahcuci->total }}</td> --}}
                                            <td>{{ $harga->nama_rekanan }}</td>
                                            <td>{{ $harga->tgl_edit_harga }}</td>
                                            <td>

                                                {{-- <a href="/dataharga/editharga/{{ $harga->id_harga }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a> --}}

                                                {{-- <a href="#" onclick="deleteharga({{$harga->id_harga}})" title="Hapus" class="btn btn-danger btn-xs" role="button"><i class="fas fa-trash"></i></a> --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                    </div>

                    {{-- Modal Tambah Data --}}
                    <div class="modal fade" id="modaltambahdata">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Harga</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form id="tambahharga" method="post">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <select id="id_barang" name="id_barang" class="form-control form-control-sm select2" required>
                                                <option></option>
                                                @foreach ($databarang as $harga)
                                                <option value="{{$harga->id_barang}}">{{$harga->nama_barang}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="harga_satuan" required="required" class="form-control form-control-sm" placeholder="Harga">
                                        </div>

                                        <div class="form-group">
                                            <select id="id_rekanan" name="id_rekanan" class="form-control form-control-sm select2" required>
                                                <option></option>
                                                @foreach ($datarekanan as $harga)
                                                <option value="{{$harga->id_rekanan}}">{{$harga->nama_rekanan}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <br>
                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

                $("#tambahharga").submit(function(event) {
                    event.preventDefault();
                    var formdata = new FormData(this);
                    $.ajax({
                        type: 'POST'
                        , dataType: 'json'
                        , url: '/dataharga/tambahharga'
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
                                location.replace("/dataharga/index");
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
                    $('#id_harga').select2({
                        placeholder: "Pilih Barang"

                    });
                });

                $(document).ready(function() {
                    $('#id_rekanan').select2({
                        placeholder: "Pilih Rekanan"
                    });
                });

            </script>
            @endpush

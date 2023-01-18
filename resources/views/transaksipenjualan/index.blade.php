@extends('layouts.main')

@section('title')
Transaksi Penjualan
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
                <h1 class="m-0">Transaksi Penjualan</h1>
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
                        <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#modaltambahdata"><i class="fas fa-plus-circle"></i>checkout</a><br><br>

                        <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Pelanggan</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Tgl Transaksi</th>
                                    {{-- <th>Aksi</th> --}}

                                </tr>
                            </thead>
                            <tbody height="10px">
                                @php $i=1 @endphp
                                @foreach($t_penjualan as $penjualan)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $penjualan->nama_barang }}</td>
                                    <td>{{ $penjualan->harga_barang }}</td>
                                    <td>{{ $penjualan->nama_pelanggan }}</td>
                                    <td>{{ $penjualan->qty_penjualan }}</td>
                                    <td>{{ $penjualan->total_penjualan }}</td>
                                    <td>{{ $penjualan->tgl_transaksi_penjualan }}</td>
                                    <td>

                                        {{-- <a href="/dataharga/editharga/{{ $harga->id_harga }}" title="Edit"
                                        class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a> --}}

                                        {{-- <a href="#" onclick="deleteharga({{$harga->id_harga}})" title="Hapus"
                                        class="btn btn-danger btn-xs" role="button"><i class="fas fa-trash"></i></a>
                                        --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Pelanggan</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Tgl Transaksi</th>

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
                                    <h4 class="modal-title">Tambah Transaksi Penjualan</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form id="tambahtransaksipenjualan" method="post">
                                        {{ csrf_field() }}
                                        <table>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <select id="id_barang" name="id_barang" class="form-control form-control-sm select2" required>
                                                            <option></option>
                                                            @foreach ($databarang as $penjualan)
                                                            <option value="{{$penjualan->id_barang}}">
                                                                {{$penjualan->nama_barang}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        {{-- <div class="form-group">
                                            <select id="id_barang" name="id_barang"
                                                class="form-control form-control-sm select2" required>
                                                <option></option>
                                                @foreach ($databarang as $penjualan)
                                                <option value="{{$penjualan->id_barang}}">{{$penjualan->nama_barang}}
                                        </option>
                                        @endforeach
                                        </select>
                                </div> --}}

                                <div class="form-group">
                                    <input type="text" name="harga_satuan" required="required" class="form-control form-control-sm" placeholder="Harga">
                                </div>

                                <div class="form-group">
                                    <select id="id_pelanggan" name="id_pelanggan" class="form-control form-control-sm select2" required>
                                        <option></option>
                                        @foreach ($datapelanggan as $penjualan)
                                        <option value="{{$penjualan->id_pelanggan}}">
                                            {{$penjualan->nama_pelanggan}}</option>
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
                    var date = new Date(data[5, 6]);

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

                // DataTables initialisation
                var table = $('#dt-basic-example').DataTable({
                    dom: 'Bfrtip'
                    , buttons: [
                        'excel'
                    , ]
                , });

                // Refilter the table
                $('#min, #max').on('change', function() {
                    table.draw();
                });
                $('#status_pelanggan').on('change', function(e) {
                    var status = $(this).val();
                    $('#status_pelanggan').val(status)
                    if (status == '1') {
                        status_pelanggan = 'Aktif'
                        console.log(status_pelanggan)
                    } else {
                        status_pelanggan = 'Tidak Aktif'
                        console.log(status_pelanggan)
                    }

                    console.log(status)
                    //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
                    table.column(4).search("^" + status_pelanggan + "$", true, false).draw();
                })
            });
            $("#tambahtransaksipenjualan").submit(function(event) {
                event.preventDefault();
                var formdata = new FormData(this);
                $.ajax({
                    type: 'POST'
                    , dataType: 'json'
                    , url: '/transsaksipenjualan/tambahtransaksipenjualan'
                    , data: formdata
                    , contentType: false
                    , cache: false
                    , processData: false
                    , success: function(data) {
                        Swal.fire(
                            'Sukses!', data.reason, 'success'
                        ).then(() => {
                            location.replace("/transaksipenjualan/index");
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
                            , url: '/transaksipenjualan/deletetransaksipenjualan/' + id_penjualan
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

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
                        <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#modaltambahdata"><i class="fas fa-plus-circle"></i> Tambah</a><br><br>

                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td><input type="text" id="min" name="min" value="<?php echo date('d-m-Y');?>">
                                    </td>
                                    <td>-</td>
                                    <td><input type="text" id="max" name="max" value="<?php echo date('d-m-Y');?>"></td>
                                </tr>

                            </tbody>
                        </table>

                        <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>No. Nota</th>
                                    <th>Pelanggan</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Total Harga</th>
                                    <th>Tgl Transaksi</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody height="10px">
                                @php $i=1 @endphp
                                @foreach ($dt_penjualan as $penjualan)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $penjualan->no_nota }}</td>
                                    <td>{{ $penjualan->namaPelanggan() }}</td>
                                    <td>{{ $penjualan->namaBarang() }}</td>
                                    <td>{{ $penjualan->qty_penjualan }}</td>
                                    <td>{{ $penjualan->total_penjualan }}</td>
                                    <td>{{ $penjualan->tgl_transaksi_penjualan }}</td>

                                    <td>
                                        <a href="/print/printpenjualan/{{ $penjualan->id_t_penjualan }}" class="btn btn-primary btn-xs"><i class="fa fa-print"></i></a>

                                        @if($penjualan->closing())

                                        <a href="/transaksipenjualan/editpenjualan/{{ $penjualan->id_dt_penjualan }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a>

                                        <a href="#" onclick="deletepenjualan({{$penjualan->id_dt_penjualan}})" title="Hapus" class="btn btn-danger btn-xs" role="button"><i class="fas fa-trash"></i></a>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Nota</th>
                                    <th>Pelanggan</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Total Harga</th>
                                    <th>Tgl Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>

                        </table>
                        <a href="/transaksipenjualan/closingpenjualan" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Closing</a><br><br>
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
                                        <input type="text" name="id_pelanggan" class="form-control" placeholder="ID Pelanggan"> <br>

                                        <input type="text" name="no_meja" class="form-control" placeholder="Nomor Meja">

                                        <table id="form_penjualan">
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                            </tr>
                                            <tr>
                                                <td id="col0">
                                                    <div class="form-group">
                                                        <select id="id_barang" name="id_barang[]" class="form-control form-control-sm select2" onchange="selectTypeNamabarang(this)" required>
                                                            <option></option>
                                                            @foreach ($databarang as $penjualan)
                                                            <option value="{{ $penjualan->id_barang }}">
                                                                {{ $penjualan->nama_barang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td id="col1">
                                                    <div class="form-group">
                                                        <input type="text" onkeyup="sum(this.parentElement.parentElement.parentElement);" id="qty_penjualan" name="qty_penjualan[]" required="required" class="form-control form-control-sm" placeholder="Qty">
                                                    </div>
                                                </td>
                                                <td id="col2">
                                                    <div class="form-group">
                                                        <input type="text" onkeyup="sum(this.parentElement.parentElement.parentElement);" id="harga_barang" name="harga_barang[]" id="harga_barang" required="required" class="form-control form-control-sm" placeholder="Harga" readonly>
                                                    </div>
                                                </td>
                                                <td id="col3">
                                                    <div class="form-group">
                                                        <input type="text" id="total_penjualan" name="total_penjualan[]" required="required" class="form-control form-control-sm" placeholder="Total" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td><input type="button" value="Add Row" onclick="addRows()" /></td>
                                                <td><input type="button" value="Delete Row" onclick="deleteRows()" />
                                                </td>
                                                <td><input type="submit" value="Submit" /></td>
                                            </tr>
                                        </table>
                                        <br>
                                        {{-- <button class="btn btn-primary" type="submit">Tambah</button> --}}
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
                        var date = new Date(data[6]);
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

                $("#tambahtransaksipenjualan").submit(function(event) {
                    event.preventDefault();
                    var formdata = new FormData(this);
                    $.ajax({
                        type: 'POST'
                        , dataType: 'json'
                        , url: '/transaksipenjualan/tambahpenjualan'
                        , data: formdata
                        , contentType: false
                        , cache: false
                        , processData: false
                        , success: function(data) {
                            Swal.fire(
                                'Sukses!', data.reason, 'success'
                            ).then(() => {
                                location.replace("/print/printpenjualan/" + data.id_penjualan);
                            });
                        }
                    });
                });

                function deletepenjualan(id_dt_penjualan) {
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
                                , url: '/transaksipenjualan/deletepenjualan/' + id_dt_penjualan
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

                function addRows() {
                    var table = document.getElementById('form_penjualan');
                    var rowCount = table.rows.length;
                    var cellCount = table.rows[0].cells.length;
                    var row = table.insertRow(rowCount);
                    for (var i = 0; i <= cellCount; i++) {
                        var cell = 'cell' + i;
                        cell = row.insertCell(i);
                        var copycel = document.getElementById('col' + i).innerHTML;
                        cell.innerHTML = copycel;
                    }
                }

                function deleteRows() {
                    var table = document.getElementById('form_penjualan');
                    var rowCount = table.rows.length;
                    if (rowCount > '2') {
                        var row = table.deleteRow(rowCount - 1);
                        rowCount--;
                    } else {
                        alert('There should be atleast one row');
                    }
                }

                function selectTypeNamabarang(item) {
                    var parent = item.parentElement.parentElement.parentElement;
                    var formdata = new FormData();
                    formdata.append('id_barang', item.options[item.selectedIndex].value);
                    $.ajax({
                        type: 'POST'
                        , dataType: 'json'
                        , url: '/transaksipenjualan/getbarang'
                        , data: formdata
                        , contentType: false
                        , cache: false
                        , processData: false
                        , success: function(data) {
                            parent.querySelector("#harga_barang").value = data.harga_barang;
                            // $('#harga_barang').val(data.harga_barang);
                        }
                    })
                }

                function sum(tableRow) {
                    // console.log(tableRow.querySelector("#harga_barang").value);
                    var txtFirstNumberValue = tableRow.querySelector("#qty_penjualan").value;
                    var txtSecondNumberValue = tableRow.querySelector("#harga_barang").value;
                    var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
                    if (!isNaN(result)) {
                        tableRow.querySelector("#total_penjualan").value = result;
                    }
                }

            </script>
            @endpush

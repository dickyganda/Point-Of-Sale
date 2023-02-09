@extends('layouts.main')

@section('title')
Closing
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
                <h1 class="m-0">Closing</h1>
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
                        <button class="btn btn-danger btn-xs" onclick="closing()"><i class="fa fa-times-circle"></i>
                            Closing</button>
                        {{-- <a href="" class="btn btn-success btn-xs" title="Closing" role="button" data-toggle="modal" data-target="#modaltambahdata"><i class=""></i>Closing</a><br><br> --}}

                        <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Rekanan</th>
                                    <th>Jumlah Penjualan</th>
                                    <th>Total Penjualan</th>
                                    <th>Kas 5%</th>
                                    <th>Income</th>
                                    <th>Status Closing</th>
                                </tr>
                            </thead>
                            <tbody height="10px">
                                @php $i=1 @endphp
                                @foreach ($t_penjualan as $closing)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $closing->tanggal }}</td>
                                    <td>{{ $closing->partner }}</td>
                                    <td>{{ $closing->sum_qty }}</td>
                                    <td>{{ $closing->sum_price }}</td>
                                    <td>{{ $closing->sum_kas }}</td>
                                    <td>{{ $closing->income }}</td>
                                    <td>{{ $closing->status_closing }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Nama Rekanan</th>
                                        <th>Jumlah Penjualan</th>
                                        <th>Total Penjualan</th>
                                        <th>Kas 5%</th>
                                        <th>Income</th>
                                        <th>Status Closing</th>
                                    </tr>
                                </tfoot> --}}
                        </table>
                    </div>

                    {{-- Modal Tambah Data --}}
                    {{-- <div class="modal fade" id="modaltambahdata">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Transaksi Penjualan</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="tambahtransaksipenjualan" method="post">
                                            {{ csrf_field() }}
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
                                    <select id="id_barang" name="id_barang" class="form-control form-control-sm select2" onchange="selectTypeNamabarang(this)" required>
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
                                    <input type="text" onkeyup="sum();" id="qty_penjualan" name="qty_penjualan" required="required" class="form-control form-control-sm" placeholder="Qty">
                                </div>
                            </td>
                            <td id="col2">
                                <div class="form-group">
                                    <input type="text" onkeyup="sum();" id="harga_barang" name="harga_barang" id="harga_barang" required="required" class="form-control form-control-sm" placeholder="Harga">
                                </div>
                            </td>
                            <td id="col3">
                                <div class="form-group">
                                    <input type="text" id="total_penjualan" name="total_penjualan" required="required" class="form-control form-control-sm" placeholder="Total">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>

        <!-- /.col-md-6 -->
    </div> --}}
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

    function closing() {
        $.ajax({
            type: 'POST'
            , dataType: 'json'
            , url: '/transaksipenjualan/closingpenjualan'
            , data: {
                '_token': "{{ csrf_token() }}"
            }
            , success: function(data) {
                Swal.fire(
                    'Sukses!', data.reason, 'success'
                ).then(() => {
                    location.reload();
                });
            }
        , });
    }

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
            , url: '/transaksipenjualan/tambahpenjualan'
            , data: formdata
            , contentType: false
            , cache: false
            , processData: false
            , success: function(data) {
                Swal.fire(
                    'Sukses!', data.reason, 'success'
                ).then(() => {
                    location.replace("/print/printpenjualan");
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
                $('#harga_barang').val(data.harga_barang);
            }
        })
    }

    function sum() {
        var txtFirstNumberValue = document.getElementById('qty_penjualan').value;
        var txtSecondNumberValue = document.getElementById('harga_barang').value;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('total_penjualan').value = result;
        }
    }

</script>
@endpush

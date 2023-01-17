@extends('layouts.main')

@section('title')
Data Master Rekanan
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
                <h1 class="m-0">Data Master Rekanan</h1>
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
                        <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#modaltambahdata"><i class="fas fa-plus-circle"></i></a><br><br>
                        {{-- filter --}}
                        {{-- <div class="row">
                            <div class="col-sm-3">
                                <select id="status_pelanggan" name="id_class" class="form-control select2 form-select-sm" required>
                                    <option></option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select><br>
                            </div> --}}
                        <br><br>
                    </div>
                    {{-- endfilter --}}
                    <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody height="10px">
                            @php $i=1 @endphp
                            @foreach($datarekanan as $rekanan)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $rekanan->nama_rekanan }}</td>
                                <td>{{ $rekanan->alamat_rekanan }}</td>
                                <td>{{ $rekanan->no_telepon_rekanan }}</td>
                                <td>{{ $rekanan->email_rekanan }}</td>
                                <td>

                                    <a href="/datarekanan/editrekanan/{{ $rekanan->id_rekanan }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a>

                                    <a href="#" onclick="deleterekanan({{$rekanan->id_rekanan}})" title="Hapus" class="btn btn-danger btn-xs" role="button"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Aksi</th>

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
                                <h4 class="modal-title">Tambah Data Rekanan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form id="tambahrekanan" method="post">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <input type="text" name="nama_rekanan" required="required" class="form-control form-control-sm" placeholder="Nama">
                                    </div>

                                    <div class="form-group">
                                        <input type="textarea" name="alamat_rekanan" required="required" class="form-control form-control-sm" placeholder="Alamat">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="no_telepon_rekanan" required="required" class="form-control form-control-sm" placeholder="Telepon">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email_rekanan" required="required" class="form-control form-control-sm" placeholder="Email">
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
            $("#tambahrekanan").submit(function(event) {
                event.preventDefault();
                var formdata = new FormData(this);
                $.ajax({
                    type: 'POST'
                    , dataType: 'json'
                    , url: '/datarekanan/tambahrekanan'
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
                            location.replace("/datarekanan/index");
                        });
                    }
                });
            });

            function deleterekanan(id_rekanan) {
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
                            , url: '/datarekanan/deleterekanan/' + id_rekanan
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

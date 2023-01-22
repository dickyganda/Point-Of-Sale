@extends('layouts.main')

@section('title')
Edit User
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit User</h1>
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
                        @foreach($datauser as $user)
                        <form id="edituser" method="post">

                            <input type="hidden" name="id_user" class="form-control form-control-sm" value="{{ $user->id_user }}" hidden>

                            <input type="text" name="nama_user" class="form-control form-control-sm" style="width:30%;" value="{{ $user->nama_user }}"> <br>

                            <input type="password" name="password_user" class="form-control form-control-sm" style="width:30%;" value="{{ $user->password_user }}"> <br>

                            <div class="form-group">
                                <select id="level_user" name="level_user" class="form-control form-control-sm select2" style="width:30%;" required>
                                    <option></option>
                                    <option value="administrator">Administrator</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="rekanan">Rekanan</option>
                                </select>
                            </div>
                            {{-- <input type="text" name="level_user" class="form-control form-control-sm" style="width:30%;" value="{{ $user->level_user }}"> <br> --}}

                            Status

                            @if ( $user->status_user == '1' )
                            <input type="radio" name="status_user" value="1" checked>
                            <label for="aktif">Aktif</label>
                            <input type="radio" name="status_user" value="0">
                            @else
                            <input type="radio" name="status_user" value="1">
                            <label for="aktif">Aktif</label>
                            <input type="radio" name="status_user" value="0" checked>
                            @endif
                            <label for="tidakaktif">Tidak Aktif</label>
                            <br />

                            <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                            <a href="/datarekanan/index" class="btn btn-warning btn-sm" role="button"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        </form>
                        @endforeach

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
        $("#edituser").submit(function(event) {
            event.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                type: 'POST'
                , dataType: 'json'
                , url: '/datauser/updateuser'
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
                        location.replace("/datauser/index");
                    });
                }
            });
        });
        $(document).ready(function() {
            $('#level_user').select2({
                placeholder: "Pilih Level"

            });
        });

    </script>
    @endpush

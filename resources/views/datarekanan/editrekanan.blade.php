@extends('layouts.main')

@section('title')
Edit Rekanan
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Rekanan</h1>
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
                        @foreach($datarekanan as $rekanan)
                        <form id="editrekanan" method="post">

                            <input type="hidden" name="id_rekanan" class="form-control form-control-sm" value="{{ $rekanan->id_rekanan }}" hidden>

                            <input type="text" name="nama_rekanan" class="form-control form-control-sm" style="width:30%;" value="{{ $rekanan->nama_rekanan }}"> <br>

                            <input type="text" name="alamat_rekanan" class="form-control form-control-sm" style="width:30%;" value="{{ $rekanan->alamat_rekanan }}"> <br>

                            <input type="text" name="no_telepon_rekanan" class="form-control form-control-sm" style="width:30%;" value="{{ $rekanan->no_telepon_rekanan }}"> <br>

                            <input type="email" name="email_rekanan" class="form-control form-control-sm" style="width:30%;" value="{{ $rekanan->email_rekanan }}"> <br>

                            <button class="btn btn-primary btn-xs" type="submit"><i class="fas fa-save"></i> Save</button>
                            <a href="/datarekanan/index" class="btn btn-warning btn-xs" role="button"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
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
        $("#editrekanan").submit(function(event) {
            event.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                type: 'POST'
                , dataType: 'json'
                , url: '/datarekanan/updaterekanan'
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
        $(document).ready(function() {
            $('#class').select2({
                placeholder: "Pilih Kelas"

            });
            $('#rt').select2({
                placeholder: "Pilih RT"

            });
        });

    </script>
    @endpush

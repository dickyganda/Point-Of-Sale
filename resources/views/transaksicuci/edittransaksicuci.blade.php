@extends('layouts.main')

@section('title')
Edit Barang
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Barang</h1>
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
                        @foreach($databarang as $barang)
                        <form id="editbarang" method="post">

                            <input type="hidden" name="id_barang" class="form-control form-control-sm" value="{{ $barang->id_barang }}" hidden>

                            <input type="text" name="nama_barang" class="form-control form-control-sm" style="width:30%;" value="{{ $barang->nama_barang }}"> <br>

                            <input type="text" name="harga_barang" class="form-control form-control-sm" style="width:30%;" value="{{ $barang->harga_barang }}"> <br>

                            <div class="form-group">
                                <select id="id_rekanan" name="id_rekanan" value="{{ $barang->id_rekanan }}" class="form-control form-control-sm select2" required>
                                    <option></option>
                                    @foreach ($databarang as $rekanan)
                                    <option value="{{$rekanan->id_rekanan}}">{{$rekanan->id_rekanan}}</option>
                                    @endforeach
                                </select>
                            </div>


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
        $("#editbarang").submit(function(event) {
            event.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                type: 'POST'
                , dataType: 'json'
                , url: '/databarang/updatebarang'
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
                        location.replace("/databarang/index");
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

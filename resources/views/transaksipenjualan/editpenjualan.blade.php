@extends('layouts.main')

@section('title')
Edit Penjualan
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Penjualan</h1>
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
                        <form id="editpenjualan" method="post">
                            @csrf
                            <input type="hidden" name="id_dt_penjualan" class="form-control form-control-sm" value="{{ $dt_penjualan->id_dt_penjualan }}" hidden>

                            {{-- <input type="text" name="nama_barang" class="form-control form-control-sm" style="width:30%;" value="{{ $pelanggan->nama_pelanggan }}"> <br> --}}
                            {{-- <div class="form-group">
                                <select id="id_barang" name="id_barang" style="width:30%;" class="form-control form-control-sm select2" onchange="selectTypeNamabarang(this)" required>
                                    <option></option>
                                    @foreach ($databarang as $penjualan)
                                    <option value="{{$penjualan->id_barang}}">
                            {{$penjualan->nama_barang}}</option>
                            @endforeach
                            </select>
                    </div> --}}

                    {{-- <input type="text" name="harga_barang" class="form-control form-control-sm" style="width:30%;" value="{{ $penjualan->harga_barang }}"> <br> --}}

                    <label>Qty penjualan</label>
                    <input type="text" name="qty_penjualan" class="form-control form-control-sm" style="width:30%;" value="{{ $dt_penjualan->qty_penjualan }}"> <br>

                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    <a href="/transaksipenjualan/index" class="btn btn-warning btn-sm" role="button"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                    </form>

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
    $("#editpenjualan").submit(function(event) {
        event.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            type: 'POST'
            , dataType: 'json'
            , url: '/transaksipenjualan/updatepenjualan'
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
                    location.replace("/transaksipenjualan/index");
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

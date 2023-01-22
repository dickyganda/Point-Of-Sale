@extends('layouts.main')

@section('title')
Report
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
                <h1 class="m-0">Report</h1>
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
                        'Sukses!'
                        , data.reason
                        , 'success'
                    ).then(() => {
                        location.replace("/transaksikas/index");
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

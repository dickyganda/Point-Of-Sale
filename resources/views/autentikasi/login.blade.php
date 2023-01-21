<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
</head>
<body>
    <div class="login">
        <div class="avatar">
            <img src="{{asset('assets/img/logo.png') }}" />
        </div>
        <h2>Login</h2>
        <h3>Welcome</h3>

        <form class="login-form" id="loginform">
            {{ csrf_field() }}
            <div class="textbox">
                <input type="teks" id="nama_user" placeholder="Nama" />
                <span class="material-symbols-outlined"> account_circle </span>
            </div>
            <div class="textbox">
                <input type="password" id="password_user" placeholder="Password" />
                <span class="material-symbols-outlined"> lock </span>
            </div>
            <button id="loginbutton" type="submit">LOGIN</button>
            {{-- <a href="#">Forgot your credentials?</a> --}}
        </form>
    </div>
</body>

<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/js/demo.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/sweetalert2.js') }}"></script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
    $(document).ready(function() {
        $("#loginform").submit(function(event) {
            event.preventDefault();
            var formdata = new FormData(this);
            console.log(FormData);
            formdata.append('nama_user', $("#nama_user").val());
            formdata.append('password_user', $("#password_user").val());
            $.ajax({
                type: 'POST'
                , dataType: 'json'
                , url: '/dashboard/index'
                , data: formdata
                , contentType: false
                , cache: false
                , processData: false
                , success: function(data) {
                    if (data.status == 'failed') {
                        Swal.fire(
                            'Gagal'
                            , data.reason
                            , 'error'
                        );
                    } else {
                        window.location.href = "{{ route('dashboard')}}"
                    }
                }
            });
        });
    });

</script>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
</head>
<body>
    <div class="login">
        <div class="avatar">
            <img src="{{asset('assets/img/avatar.png') }}" />
        </div>
        <h2>Login</h2>
        <h3>Welcome</h3>

        <form class="login-form">
            <div class="textbox">
                <input type="email" placeholder="Username" />
                <span class="material-symbols-outlined"> account_circle </span>
            </div>
            <div class="textbox">
                <input type="password" placeholder="Password" />
                <span class="material-symbols-outlined"> lock </span>
            </div>
            <button type="submit">LOGIN</button>
            {{-- <a href="#">Forgot your credentials?</a> --}}
        </form>
    </div>
</body>
</html>

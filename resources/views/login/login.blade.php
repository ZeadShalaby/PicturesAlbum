<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link rel="stylesheet" href="{{ asset('css/Login_Register/info.css') }}">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="POST" action="/register">
                @csrf
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="firstname" placeholder="User name" name="firstname" required="">
                <input type="text" name="lastname" placeholder="User name" name="lastname" required="">
                <input type="email" name="email" placeholder="email" required="">
                <input type="password" name="Password" placeholder="password" required="">
                <button>Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="/login">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" name="email" required="">
                <input type="password" name="Password" placeholder="Password" name="password" required="">
                <button>Login</button>
            </form>
        </div>
    </div>
</body>

</html>

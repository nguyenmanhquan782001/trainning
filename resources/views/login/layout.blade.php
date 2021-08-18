<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V16</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset("login/images/icons/favicon.ico") }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/vendor/bootstrap/css/bootstrap.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/fonts/font-awesome-4.7.0/css/font-awesome.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/vendor/animate/animate.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/vendor/css-hamburgers/hamburgers.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/vendor/animsition/css/animsition.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/vendor/select2/select2.min.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/vendor/daterangepicker/daterangepicker.css") }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset("login/css/util.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("login/css/main.css") }}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('{{ asset("login/images/bg-01.jpg") }}');">
        <div class="wrap-login100 p-t-30 p-b-50">
            @yield("login_or_register")

        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>


</body>
</html>

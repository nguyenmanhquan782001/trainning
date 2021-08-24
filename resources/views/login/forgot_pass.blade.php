<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Quên mật khẩu</title>
</head>
<body>
<div class="container">
    @if(session("success"))

    @endif
    <div class="row">
        <div class="col-4">
        </div>
        <div class="col-4" style="border: 1px solid #f4f4f4 ; border-radius: 10px ; padding: 50px; margin: 50px auto">
            <form action="{{ route("forgot.post") }}" method="post">
                @csrf
                <div class="form-group">
                    <input name="email" type="email" class="form-control" placeholder="Nhập email....">
                </div>
                <div style="padding-left: 20px">
                    <button type="submit" class="btn btn-primary">Lấy lại mật khẩu</button>
                    <a  href="{{ route("login.view") }}" class="btn btn-warning">Quay lại</a>
                </div>
            </form>
        </div>
        <div class="col-4">

        </div>
    </div>

</div>
@include('sweetalert::alert')

</body>
</html>

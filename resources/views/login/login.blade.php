@extends("login.layout")
@section("title" , "Login")
@section("login_or_register")
    @if(session("success"))

    @endif
    <span class="login100-form-title p-b-41">
					Account Login
				</span>
    <form action="{{ route("login.post") }}" method="post" class="login100-form validate-form p-b-33 p-t-5">
        @csrf
        <div class="wrap-input100 validate-input" data-validate="Enter email">
            <input value="{{ old("email") }}"  autocomplete="off" class="input100" type="email" name="email" placeholder="Email đăng nhập">
            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>
        @error('email')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror


        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input value="{{ old('password') }}" class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        @error('password')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror
        <div class="container-login100-form-btn m-t-32">
            <button type="submit" class="login100-form-btn">
                Login
            </button>
            <a href="{{ route("register.view") }}" class="login100-form-btn" style="margin-left: 3px">
                Register
            </a>
           <div style="margin-top: 20px">
               <a class="btn btn-danger" href="{{ route("login.redirect") }}">Login with google</a>
               <a class="btn btn-primary" href="{{ route("login.redirect") }}">Login with Facebook</a>
           </div>

            <br>
            <div style="margin-top: 20px ; opacity: 0.7" >
                <span> Google + </span>
                <a style="color: blue" href="">Quên mật khẩu</a>
            </div>

        </div>

    </form>
@endsection

@extends("login.layout")
@section("login_or_register")
    <span class="login100-form-title p-b-41">
					Account Login
				</span>
    <form action="{{ route("login.post") }}" method="post" class="login100-form validate-form p-b-33 p-t-5">
        @csrf
        <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input autocomplete="off" class="input100" type="email" name="email" placeholder="Email đăng nhập">
            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>
        @error('email')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror


        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        @error('password')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror
        <div class="container-login100-form-btn m-t-32">
            <button type="submit" class="login100-form-btn">
                Login
            </button>
            <a href="{{ route("register.view") }}" class="login100-form-btn">
                Register
            </a>
        </div>

    </form>
@endsection

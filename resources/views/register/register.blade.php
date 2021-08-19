@extends("login.layout")
@section("login_or_register")
    <span class="login100-form-title p-b-41">
					Register
				</span>
    <form action="{{ route("register.post") }}" method="post" class="login100-form validate-form p-b-33 p-t-5">
        @csrf
        <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input autocomplete="off" class="input100" type="email" name="email" placeholder="Email">
            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>
        @error('email')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror

        <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input autocomplete="off" class="input100" type="text" name="name" placeholder="username">
            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>
        @error('name')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror

        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        @error('password')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror
        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password_confirm" placeholder="Password confirm">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        @error('password_confirm')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror

        <div class="container-login100-form-btn m-t-32">
            <button type="submit" class="login100-form-btn">
                Register
            </button>
            <a href="{{ route("login.view") }}" class="login100-form-btn">
                Login
            </a>
        </div>

    </form>
@endsection


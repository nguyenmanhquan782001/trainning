@extends("login.layout")
@section("title" , "Change Password")
@section("login_or_register")
    @if(session("success"))

    @endif
    <span class="login100-form-title p-b-41">
				Đổi mật khẩu
				</span>
    <form action="{{ route("change") }}" method="post" class="login100-form validate-form p-b-33 p-t-5">
        @csrf

        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input value="{{ old("password") }}" class="input100" type="password" name="password" placeholder="Mật khẩu mới">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        @error('password')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror
        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input value="{{ old("password_confirm") }}" class="input100" type="password" name="password_confirm" placeholder="Nhập lại mật khẩu mới">
            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>
        @error('password_confirm')
        <i style="margin: 5px 15px; color: red">{{ $message }}</i>
        @enderror
        <div class="container-login100-form-btn m-t-32">
            <button type="submit" class="login100-form-btn">
                refresh password
            </button>
        </div>

    </form>
@endsection

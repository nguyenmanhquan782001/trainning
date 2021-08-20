<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLogin;
use App\Http\Requests\PostRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    public function login()
    {
        return view("login.login");
    }

    public function store(PostLogin $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");
        $login_email = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
        if ($login_email) {
            return redirect()->route("dashboard.index")->with("toast_success", "OK fine");
        }
        $user = User::where("email", $email)->first();
        if (!$user) {
            return redirect()->back()->with("toast_info", "Sai email")->withInput();
        }
        if (Hash::check($password, $user->password) == false) {
            return redirect()->back()->with("toast_info", "Mật khẩu không chính xác")->withInput();
        } else {
            return redirect()->back()->with("toast-warning", "Tài khoản bị khóa or không tồn tại")->withInput();
        }
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user_google = Socialite::driver('google')->user();
            $user_check = User::where('google_id', $user_google->id)->first();
            if ($user_check) {
                Auth::login($user_check);
                return redirect("admin/dashboard");
            } else {
                $newUser = new User();
                $newUser->name = $user_google->name;
                $newUser->email = $user_google->email;
                $newUser->avatar = $user_google->avatar;
                $newUser->google_id = $user_google->id;
                $newUser->password = "";
                $newUser->save();
                Auth::login($newUser);
                if ($newUser->password == null) {
                    return redirect()->route("forgot");
                }
                return redirect()->route("dashboard.index");
            }
        } catch (\Exception $e) {
             return redirect()->route("login.view")->with("toast_warning" , 'Có lỗi xảy ra vui lòng thử lại');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login.view")->with("toast_success", "Đã đăng xuất");
    }

    public function forgot()
    {
        return view("register.forgot");
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'password' => "required|min:6",
            "password_confirm" => "required|same:password"
        ];
        $message = [
            "password.required" => "Không được để trống password",
            "password.min" => "Pass phải lớn hơn 6 kí tự",
            "password_confirm.required" => "Không để trống password xác nhận",
            "password_confirm.same" => "Không trùng password"
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $user = User::find(Auth::id());
        $password = $request->input("password");
        if ($user) {
            $user->password = Hash::make($password);
            $user->save();
            Auth::attempt(['email' => $user->email, 'password' => $user->password]);
            return redirect()->route("dashboard.index");
        }
        return redirect()->back()->with("toast_info", 'Có lỗi xảy ra vui lòng thử lại');
    }

}

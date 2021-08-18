<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLogin;
use App\Http\Requests\PostRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Register\RegisterInterface;

class LoginController extends Controller
{
    public $register;

    public function __construct(RegisterInterface $register)
    {
        $this->register = $register;
    }

    public function login()
    {
        return view("login.login");
    }

    public function postLogin(PostLogin $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");
        $login_email = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
        if ($login_email) {
            return redirect()->route("dashboard.index")->with("success", "OK fine");
        }
        $user = User::where("email", $email)->first();
        if (!$user) {
            return "Email không chính xác";
        }
        if (Hash::check($password, $user->password) == false) {
            return "Password không chính xác";
        } else {
            return "Tài khoản ko tồn tại hoặc có thể bị khóa vui lòng liên hệ lại với quản trị viên";
        }
    }

    public function register()
    {
        return view("login.register");
    }

    public function postRegister(PostRegister $request)
    {
        $email = $request->input("email");
        $name = $request->input("name");
        $password = $request->input("password");
        $data = [];
        $data['name'] = $name;
        $data['email'] = $email;
        $data['password'] = Hash::make($password);
        $this->register->store($data);
        return redirect()->route("login.view");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login.view");
    }

}

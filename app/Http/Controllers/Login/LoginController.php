<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLogin;
use App\Http\Requests\PostRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            return redirect()->back()->with("toast_info" , "Sai email");
        }
        if (Hash::check($password, $user->password) == false) {
            return redirect()->back()->with("toast_info" , "Mật khẩu không chính xác");
        } else {
            return redirect()->back()->with("toast-warning" , "Tài khoản bị khóa or không tồn tại");
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
            if($user_check){
                return redirect()->route("dashboard.index");
            }else{
                $newUser = new User();
                $newUser->name = $user_google->name;
                $newUser->email = $user_google->email;
                $newUser->avatar = $user_google->avatar;
                $newUser->google_id = $user_google->id;
                $newUser->password = Hash::make('1234567');
                $newUser->save();
                Auth::login($newUser);
                return redirect()->route("dashboard.index");
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login.view");
    }



}

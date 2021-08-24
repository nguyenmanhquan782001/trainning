<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRegister;
use App\Models\User;
use App\Repositories\Register\RegisterInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public $register;

    public function __construct(RegisterInterface $register)
    {
        $this->register = $register;
    }

    public function register()
    {
        return view("register.register");
    }

    public function store(PostRegister $request)
    {
        $email = $request->input("email");
        $name = $request->input("name");
        $password = $request->input("password");
        $data = [];
        $data['name'] = $name;
        $data['email'] = $email;
        $data['password'] = Hash::make($password);
        $this->register->store($data);
        Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        Mail::to("$email")->send(new SendMail());
        return redirect()->back()->with("toast_success", 'Đăng kí thành công ! check email để xác nhận');
    }

    public function verification()
    {
        $user = \auth()->user();
        $user_check = User::find($user->id);
        if ($user_check) {
            $user_check->status = 1 ;
            $user_check->save();
        }
        return redirect()->route("login.view")->with("toast_success", "Đã xác minh tài khoản mời đăng nhập");
    }


}

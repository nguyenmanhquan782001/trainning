<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRegister;
use App\Repositories\Register\RegisterInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use App\Jobs\SendEmail;

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
        SendEmail::dispatch($email, $name)->delay(now()->addMinute(10));
        return redirect()->back()->with("toast-success", 'Đăng kí thành công check email để xác nhận');
    }

}

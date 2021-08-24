<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            "name" => "required|string|between:2,100",
            "email" => "required|string|email|max:100|unique:users",
            "password" => "required|string|confirmed|min:6",
        ];
        $message = [
            "name.required" => "Không được để trống tên",
            "name.string" => "Phải là 1 chuỗi",
            "name.between" => "Chuỗi phải từ 2 -> 100",
            "email.required" => "Không để trống email",
            "email.string" => "Phải là 1 chuỗi",
            "email.email" => "Phải đúng định dạng email",
            "email.max" => "Tối đa 100 kí tự",
            "email.unique" => "Email này đã được đăng kí",
            "password.required" => "Không được để trống password",
            "password.string" => "Mật khẩu phải là 1 chuỗi",
            "password.confirmed" => "Password xác nhận không đúng",
            "password.min" => "Password phải lớn hơn hoặc bằng 6 kí tự",
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->input('password'))]
        ));
        return response()->json([
            'message' => "Đăng kí thành công",
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $rules = [
            "email" => "required|email",
            "password" => "required|min:6"
        ];
        $message = [
            "email.required" => "Không được để trống email",
            "email.email" => "Phải đúng định dạng email",
            "password.required" => "Phải nhập password",
            "password.min" => "Password lớn hơn 6 kí tự"
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $token = auth()->attempt($validator->validated());
        if (!$token) {
            return response()->json([
                'message' => "Không tồn tại user này"
            ], 401);
        }
        return $this->createNewToken($token);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => "Đã đăng xuất"
        ]);
    }

    public function userProfile()
    {
        return response()->json(\auth()->user());
    }

    public function refresh()
    {
        return $this->createNewToken(\auth()->refresh());
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => "required|min:6",
            'password' => "required|confirmed|min:6"
        ];
        $message = [
            "old_password.required" => "Password cũ không được để trống",
            "old_password.min" => "Password cũ phải lớn hơn hoặc bằng 6 kí tự",
            "password.required" => "Password mới ko để trống",
            "password.confirmed" => "Password chưa confirm",
            "password.min" => "Password lớn hơn băng 6 kí tự"
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $userId = \auth()->user()->id;
        if (Hash::check($request->input("old_password"), \auth()->user()->password) == false) {
            return response()->json([
                'message' => "Mật khẩu cũ không đúng",
            ]);
        }
        $user = User::where("id", $userId)->update([
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['message' => "Đổi mật khẩu thành công", 'user' => $user]);
    }


    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


}

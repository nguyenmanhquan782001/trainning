<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => "required|unique:users,email",
            "name" => "required|min:6",
            "password" => "required|min:6",
            "password_confirm" => "required|same:password",
        ];
    }
    public  function messages()
    {
       return [
          'email.required' => "Không được để trống email" ,
          "email.unique" => "Email đã có user đăng kí",
          "name.required" => "Không được để trống username",
          "name.min" => "User name phải lớn hơn hoặc bằng 6 kí tự",
          "password.required" => "Password không được để trống",
          "password.min" => "Password lớn hơn 6 kí tự",
          "password_confirm.required" => "Không được để trống password xác nhận" ,
          "password_confirm.same" => "Password xác nhận không khớp",
       ];
    }
}

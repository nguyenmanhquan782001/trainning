<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostLogin extends FormRequest
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
            'email' => "required|email",
            'password' => "required|min:6"
        ];
    }
    public function messages()
    {
        return [
            'email.required' => "Không được để trống email",
            'email.email' => "Phải đúng định dạng email",
            'password.required' => "Chưa nhập mật khẩu",
            'password.min' => "Password lớn hơn 6 kí tự"
        ];
    }

}

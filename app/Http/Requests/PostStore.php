<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStore extends FormRequest
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
            'title' => "required",
            "content" => "required" ,
            "slug" => "required",
        ];
    }
    public  function messages()
    {
        return [
            'title.required' => "Chưa có tiêu đề",
            "content.required" => "Nội dung còn trống",
            "slug.required" => "Không có nội dung"
        ];
    }
}

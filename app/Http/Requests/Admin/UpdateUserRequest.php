<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           "name"=>"required|min:5|max:10",
           "phone_number"=>"required|numeric|min:9",
           "address"=>"required",
           "email"=>"required|email",
           "password"=>"required|min:8|",
        ];
    }
    public function messages()
    {
        return [
            "name.required"=>"Không được để trống tên người dùng",
            "name.min"=>"Tên người dùng bắt buộc phải trên 5 kí tự",
            "name.max"=>"Tên người dùng bắt buộc phải dưới 10 kí tự",
            "phone_number.required"=>"Không được để trống số điện thoại",
            "phone_number.min"=>"Số điện thoại bắt buộc phải trên 9 kí tự",
            "phone_number.numeric"=>"Số điện thoại bắt buộc phải là dạng số",
            "email.required"=>"Không được để email",
            "email.email"=>"Email không đúng",
            "password.required"=>"Không được để password trống",
            "password.min"=>"Pass tối thiểu phải trên 8 kí tự",
        ];
    }
}

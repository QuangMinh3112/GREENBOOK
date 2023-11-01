<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            "name"=>"required",
            "phone_number"=>"required",
            "address"=>"required",
            "email"=>"required",
            "password"=>"required",
        ];
    }
    public function messages()
{
    return [
        "name.required"=>"Không được để trống tên người dùng",
        "phone_number.required"=>"Không được để sdt",
        "address.required"=>"Không được để address",
        "email.required"=>"Không được để email",
        "password.required"=>"Không được để password",
        
    ];
}
}

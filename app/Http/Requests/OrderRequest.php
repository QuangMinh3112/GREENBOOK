<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            //
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'coupon' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống.',
            'phone_number.required' => 'Số điện thoại không được bỏ trống.',
            'address.required' => 'Địa chỉ không được bỏ trống.',
            'coupon.string' => 'Mã giảm giá phải là một chuỗi.',
        ];
    }
}

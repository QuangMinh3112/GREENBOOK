<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code'=> 'required|min:5|max:15',
            'discount'=> 'required|numeric',
            'end_time'=> 'required|date_format:Y',
            'description'=> 'required|min:10|max:255',     
        ];
    }
    public function messages()
{
    return [
        'code.required' => 'Bắt buộc phải điền code',
        'code.min' => 'Tối thiểu 5 kí tự',
        'code.max' => 'Tối đa 15 kí tự',

        'discount.required' => 'vui lòng nhập mã giảm giá',
        'discount.numeric' => 'vui lòng nhập số',

        'end_time.required' => 'vui lòng nhập thời gian',
        'end_time.date_format:Y' => 'vui lòng nhập số năm',

        'description.required' => 'Bắt buộc phải điền mô tả',
        'description.min' => 'Tối thiểu 10 kí tự',
        'description.max' => 'Tối đa 255 kí tự',
    ];
}
}

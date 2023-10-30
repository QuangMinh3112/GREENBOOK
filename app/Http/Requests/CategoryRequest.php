<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:10|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc phải điền tên',
            'name.min' => 'Tối thiểu 5 kí tự',
            'name.max' => 'Tối đa 255 kí tự',
            'description.required' => 'Bắt buộc phải điền mô tả',
            'description.min' => 'Tối thiểu 5 kí tự',
            'description.max' => 'Tối đa 255 kí tự',
        ];
    }
}

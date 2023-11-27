<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            "title"=>"required|min:5|max:55",
            'description' => 'required|min:10|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            
            'title.required' => 'Bắt buộc phải điền tên',
            'title.min' => 'Tối thiểu 5 kí tự',
            'title.max' => 'Tối đa 55 kí tự',
            'description.required' => 'Bắt buộc phải điền mô tả',
            'description.min' => 'Tối thiểu 10 kí tự',
            'description.max' => 'Tối đa 255 kí tự',
            'image.required' => 'Vui lòng tải lên ảnh sản phẩm',
            'image.image' => 'Tập tin tải lên phải là hình ảnh.',
            'image.mimes' => 'Tập tin ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2048KB.',
        ];
    }
}

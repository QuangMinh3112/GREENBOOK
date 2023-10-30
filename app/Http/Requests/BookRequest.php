<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'category_id' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'author' => 'required|min:5|max:255',
            'published_company' => 'required|min:5|max:255',
            'published_year' => 'required|date_format:Y',
            'width' => 'required|numeric|min:10',
            'height' => 'required|numeric|min:10',
            'number_of_pages' => 'required|numeric|min:1',
            'short_description' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:1024',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sách',
            'name.min' => 'Tên bắt buộc lớn hơn 5 kí tự',
            'name.max' => 'Tên bắt buộc nhỏ hơn 255 kí tự',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'price.required' => 'Vui lòng nhập giá sách',
            'price.numeric' => 'Giá tiền phải là số',
            'price.min' => 'Giá tiền phải lớn hơn 0',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.numeric' => 'Số lượng phải là số',
            'quantity.min' => 'Số lượng phải lớn hơn 0',
            'author.required' => 'Vui lòng nhập tên tác giả',
            'author.min' => 'Tên tác giả bắt buộc lớn hơn 5 kí tự',
            'author.max' => 'Tên tác giả bắt buộc nhỏ hơn 255 kí tự',
            'published_company.required' => 'Vui lòng nhập tên nhà xuất bản',
            'published_company.min' => 'Tên nhà xuất bản bắt buộc lớn hơn 5 kí tự',
            'published_company.max' => 'Tên nhà xuất bản bắt buộc nhỏ hơn 255 kí tự',
            'published_year.required' => 'Vui lòng nhập năm xuất bản',
            'published_year.date_format:Y' => 'Vui lòng nhập năm',
            'width.required' => 'Vui lòng nhập chiều rộng sách',
            'width.numeric' => 'Chiều rộng phải là số',
            'width.min' => 'Chiều rộng tối thiểu là 10 cm',
            'height.required' => 'Vui lòng nhập chiều cao sách',
            'height.numeric' => 'Chiều cao phải là số',
            'height.min' => 'Chiều cao tối thiểu là 10 cm',
            'number_of_pages.required' => 'Vui lòng nhập số trang sách',
            'number_of_pages.numeric' => 'Số trang phải là số',
            'number_of_pages.min' => 'Số trang sách phải lớn hơn 50',
            'short_description.required' => 'Vui lòng nhập mô tả ngắn',
            'short_description.min' => 'Mô tả ngắn bắt buộc lớn hơn 5 kí tự',
            'short_description.max' => 'Mô tả ngắn bắt buộc nhỏ hơn 1500 kí tự',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.min' => 'Mô tả bắt buộc lớn hơn 5 kí tự',
            'description.max' => 'Mô tả bắt buộc nhỏ hơn 6000 kí tự',
            'image.required' => 'Vui lòng tải lên ảnh sản phẩm',
            'image.image' => 'Tập tin tải lên phải là hình ảnh.',
            'image.mimes' => 'Tập tin ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2048KB.',
        ];
    }
}

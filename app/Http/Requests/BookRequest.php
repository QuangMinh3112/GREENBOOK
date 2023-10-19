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
            'short_description' => 'required|min:5|max:512',
            'description' => 'required|min:5|max:1024',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}

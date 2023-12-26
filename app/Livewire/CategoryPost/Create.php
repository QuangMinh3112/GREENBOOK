<?php

namespace App\Livewire\CategoryPost;

use App\Models\CategoryPost;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('Layout.app')]
#[Title('Thêm mới danh mục bài đăng ')]
class Create extends Component
{
    #[Validate()]
    public $name;
    public $description;
    public $parent_id;
    public function render()
    {
        return view('livewire.category-post.create', [
            "categories" => CategoryPost::tree()
        ]);
    }

    public function addNew()
    {
        $validated = $this->validate();
        CategoryPost::create([
            'name' => $validated['name'],
            'parent_id' => $this->parent_id,
            'description' => $validated['description'],
            'slug' => Str::slug($validated['name']),
        ]);
        $this->reset();
        request()->session()->flash('success', 'Thêm mới thành công');
    }
    public function rules()
    {
        return [
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

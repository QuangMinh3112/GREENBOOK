<?php

namespace App\Livewire\Post;

use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('Layout.app')]
#[Title('Thêm mới danh mục bài đăng ')]
class Create extends Component
{
    use WithFileUploads;
    #[Validate()]
    public $title;
    public $description;
    public $image;
    public $status;
    public $slug;
    public $category_id;
    public function render()
    {
        return view('livewire.post.create', [
            "categories" => CategoryPost::tree()
        ]);
    }
    public function addNew()
    {
        $user_id = Auth::user()->id;
        $validated = $this->validate();
        if ($this->image) {
            $image = $this->image->store('posts', 'public');
        }
        Post::create([
            "title" => $validated["title"],
            "content" => $validated["description"],
            "image" => $image,
            "status" => $this->status,
            "slug" => Str::slug($validated["title"]),
            "category_id" => $validated["category_id"],
            "user_id" => $user_id,
        ]);
        $this->reset();
        request()->session()->flash('success', 'Thêm mới thành công');
    }
    public function rules(): array
    {
        return [
            "title" => "required|min:5|max:55",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
            'description' => 'required'
        ];
    }
    public function messages()
    {
        return [

            'title.required' => 'Bắt buộc phải điền tên',
            'title.min' => 'Tối thiểu 5 kí tự',
            'title.max' => 'Tối đa 55 kí tự',
            'description.required' => 'Bắt buộc phải điền mô tả',
            'image.required' => 'Vui lòng tải lên ảnh bìa',
            'image.image' => 'Tập tin tải lên phải là hình ảnh.',
            'image.mimes' => 'Tập tin ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2048KB.',
            'category_id.required' => 'Vui lòng chọn danh mục'
        ];
    }
}

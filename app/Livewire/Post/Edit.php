<?php

namespace App\Livewire\Post;

use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

#[Layout('Layout.app')]
#[Title('Chỉnh sửa bài đăng ')]
class Edit extends Component
{
    use WithFileUploads;
    #[Validate()]
    public $post;
    public $title;
    public $description;
    public $status;
    public $slug;
    public $category_id;
    public $image;

    public function mount($id)
    {
        $this->post = Post::find($id);
        if ($this->post) {
            $this->title = $this->post->title;
            $this->description = $this->post->content;
            $this->status = $this->post->status;
            $this->category_id = $this->post->category_id;
        }
    }
    public function render()
    {
        return view('livewire.post.edit', [
            "categories" => CategoryPost::tree(),
            "oldImage" => $this->post->image
        ]);
    }
    public function update()
    {
        $validated = $this->validate();
        if ($this->image != null) {
            $image = $this->image->store('posts', 'public');
            $this->post->update([
                "title" => $validated["title"],
                "content" => $validated["description"],
                "image" => $image,
                "status" => $this->status,
                "slug" => Str::slug($validated["title"]),
                "category_id" => $validated["category_id"],
                "user_id" => Auth::user()->id,
            ]);
        } else {
            $this->post->update([
                "title" => $validated["title"],
                "content" => $validated["description"],
                "status" => $this->status,
                "slug" => Str::slug($validated["title"]),
                "category_id" => $validated["category_id"],
                "user_id" => Auth::user()->id,
            ]);
        }
        $this->reset('image');
        request()->session()->flash('success', 'Cập nhật thành công');
    }
    public function rules(): array
    {
        return [
            "title" => "required|min:5|max:55",
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
            'category_id.required' => 'Vui lòng chọn danh mục'
        ];
    }
}

<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

#[Layout('Layout.app')]
#[Title('Chỉnh sửa danh mục')]
class Edit extends Component
{

    #[Validate()]
    public $category;
    public $name;
    public $description;
    public $parent_id = null;

    public function mount($id)
    {
        $this->category = Category::find($id);
        if ($this->category) {
            $this->name = $this->category->name;
            $this->parent_id = $this->category->parent_id;
            $this->description = $this->category->description;
        }
    }
    public function render()
    {
        return view('livewire.category.edit', [
            'categories' => Category::tree()
        ]);
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
    public function update()
    {
        $validated = $this->validate();
        $this->category->update([
            'name' => $validated['name'],
            'parent_id' => is_numeric($this->parent_id) ? $this->parent_id : null,
            'description' => $validated['description'],
            'slug' => Str::slug($validated['name']),
        ]);
        request()->session()->flash('success', 'Cập nhật thành công');
    }
}

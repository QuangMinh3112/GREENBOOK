<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Layout('Layout.app')]
#[Title('Chỉnh sửa người dùng')]
class Edit extends Component
{
    #[Validate()]
    public $user;
    public $name;
    public $email;
    public $password;
    public $phone_number;
    public $role;
    public $status;
    public $is_vertify;

    public function mount($id)
    {
        $this->user = User::find($id);
        if ($this->user) {
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->password = $this->user->password;
            $this->phone_number = $this->user->phone_number;
            $this->role = $this->user->role;
            $this->status = $this->user->status;
            $this->is_vertify = $this->user->is_vertify;
        }
    }
    public function render()
    {
        return view('livewire.user.edit');
    }
    public function update()
    {
        $validated = $this->validate();
        $this->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'role' => $this->role,
            'status' => $this->status,
            'is_vertify' => $this->is_vertify,
        ]);
        request()->session()->flash('success', 'Cập nhật thành công');
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:5',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã tồn tại.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 5 ký tự.',
        ];
    }
}

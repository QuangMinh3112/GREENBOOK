<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('Layout.app')]
#[Title('Thêm người dùng')]
class Create extends Component
{
    #[Validate()]
    public $name;
    public $email;
    public $password;
    public $phone_number;
    public $role = 0;
    public $status = 1;
    public $is_vertify  = 0;

    public function render()
    {
        return view('livewire.user.create');
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
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
    public function addNew()
    {
        $validated = $this->validate();
        User::create([
            'name' => $validated["name"],
            'email' => $validated["email"],
            'phone_number' => $validated["phone_number"],
            'password' => bcrypt($validated["password"]),
            'role' => $this->role,
            'status' => $this->status,
            'is_vertify' => $this->is_vertify,
        ]);
        $this->reset();
        request()->session()->flash('success', 'Thêm mới thành công');
    }
}

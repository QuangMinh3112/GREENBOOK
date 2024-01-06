<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

#[Layout('Layout.app')]
#[Title('Thêm hồ sơ website')]
class Create extends Component
{

    use WithFileUploads;

    #[Validate()]
    public $logo;
    public $email;
    public $name;
    public $phone_number;
    public $address;
    public function render()
    {
        return view('livewire.setting.create');
    }
    public function addNew()
    {
        $validated = $this->validate();
        if ($this->logo) {
            $logo = $this->logo->store('profile', 'public');
        }
        Setting::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "phone_number" => $validated["phone_number"],
            "address" => $validated["address"],
            "logo" => $logo,
        ]);
        $this->reset();
        request()->session()->flash('success', 'Thêm mới thành công');
    }
    public function rules()
    {
        return [
            'logo' => 'required|image',
            'email' => 'required|email',
            'name' => 'required|max:255',
            'phone_number' => 'required|max:15',
            'address' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'logo.required' => 'Không được bỏ trống LOGO',
            'logo.image' => 'LOGO phải là một hình ảnh.',
            'email.required' => 'Trường email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'name.required' => 'Không được bỏ trống tên',
            'name.max' => 'Tối đa 255 ký tự cho phép',
            'phone_number.required' => 'Trường số điện thoại là bắt buộc',
            'phone_number.max' => 'Tối đa 15 ký tự cho phép',
            'address.required' => 'Trường địa chỉ là bắt buộc',
            'address.max' => 'Tối đa 255 ký tự cho phép',
        ];
    }
}

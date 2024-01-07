<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

#[Layout('Layout.app')]
#[Title('Chỉnh sửa hồ sơ website')]
class Edit extends Component
{
    use WithFileUploads;

    #[Validate()]
    public $setting;
    public $logo;
    public $email;
    public $name;
    public $phone_number;
    public $address;
    public $is_active;
    public function mount($id)
    {
        $this->setting = Setting::find($id);
        if ($this->setting) {
            $this->email = $this->setting->email;
            $this->name = $this->setting->name;
            $this->phone_number = $this->setting->phone_number;
            $this->address = $this->setting->address;
            $this->is_active = $this->setting->is_active;
        }
    }
    public function render()
    {
        return view('livewire.setting.edit', [
            "setting" => $this->setting,
            "oldLogo" => $this->setting->logo,
        ]);
    }
    public function update()
    {
        $validated = $this->validate();
        if ($this->logo != null) {
            $logo = $this->logo->store('profile', 'public');
            $this->setting->update([
                "name" => $validated["name"],
                "email" => $validated["email"],
                "phone_number" => $validated["phone_number"],
                "address" => $validated["address"],
                "logo" => $logo,
                "is_active" => $this->is_active,
            ]);
        } else {
            $this->setting->update([
                "name" => $validated["name"],
                "email" => $validated["email"],
                "phone_number" => $validated["phone_number"],
                "address" => $validated["address"],
                "is_active" => $this->is_active,
            ]);
        }
        if ($this->is_active == 1) {
            $allSetting = Setting::where('id', '!=', $this->setting->id)->update(["is_active" => 0]);
        }
        request()->session()->flash('success', 'Cập nhật thành công');
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

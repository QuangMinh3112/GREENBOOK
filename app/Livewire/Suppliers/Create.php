<?php

namespace App\Livewire\Suppliers;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Layout('Layout.app')]
#[Title('Thêm mới nhà cung cấp')]
class Create extends Component
{
    #[Validate()]
    public $name;
    public $email;
    public $address;
    public $phone_number;
    public $fax;
    public function render()
    {
        return view('livewire.suppliers.create');
    }
    public function addNew()
    {
        $validated = $this->validate();
        Supplier::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "address" => $validated["address"],
            "phone_number" => $validated["phone_number"],
            "fax" => $validated["fax"],
        ]);
        $this->reset();
        request()->session()->flash('success', 'Thêm mới thành công');
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'fax' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Không bỏ trống tên.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'phone_number.required' => 'Không bỏ trống số điện thoại.',
            'phone_number.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'email.required' => 'Không bỏ trống email.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'fax.max' => 'Fax không được vượt quá 20 ký tự.',
            'address.required' => 'Không bỏ trống địa chỉ.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ];
    }
}

<?php

namespace App\Livewire\Coupon;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('Layout.app')]
#[Title('Chỉnh sửa mã giảm giá')]
class Edit extends Component
{
    #[Validate()]
    public $coupon;
    public $name;
    public $value;
    public $type;
    public $quantity;
    public $startDate;
    public $endDate;
    public $pointRequired;
    public $priceRequired;

    public function mount($id)
    {
        $this->coupon = Coupon::find($id);
        if ($this->coupon) {
            $this->name = $this->coupon->name;
            $this->value = $this->coupon->value;
            $this->type = $this->coupon->type;
            $this->quantity = $this->coupon->quantity;
            $this->startDate = $this->coupon->start_date;
            $this->endDate = $this->coupon->end_date;
            $this->pointRequired = $this->coupon->point_required;
            $this->priceRequired = $this->coupon->price_required;
        }
    }
    public function render()
    {
        return view('livewire.coupon.edit');
    }
    public function update()
    {
        $validated = $this->validate();
        $this->coupon->update([
            "name" => $validated["name"],
            "value" => $validated["value"],
            "type" => $validated["type"],
            "quantity" => $validated["quantity"],
            "start_date" => $validated["startDate"],
            "end_date" => $validated["endDate"],
            "point_required" => $validated["pointRequired"],
            "price_required" => $this->priceRequired,
        ]);
        request()->session()->flash('success', 'Cập nhật thành công');
    }
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'value' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'pointRequired' => 'required|integer|min:0',
            'type' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'value.required' => 'Vui lòng nhập giá trị.',
            'value.numeric' => 'Giá trị phải là số.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1.',
            'startDate.required' => 'Vui lòng nhập ngày bắt đầu.',
            'startDate.date' => 'Ngày bắt đầu không hợp lệ.',
            'endDate.required' => 'Vui lòng nhập ngày kết thúc.',
            'endDate.date' => 'Ngày kết thúc không hợp lệ.',
            'endDate.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'pointRequired.required' => 'Vui lòng nhập số điểm cần thiết',
            'pointRequired.integer' => 'Số điểm phải là số nguyên',
            'pointRequired.min' => 'Số điểm phải lớn hơn 0',
            'type.required' => 'Vui lòng chọn loại KM',

        ];
    }
}

<?php

namespace App\Livewire\Coupon;

use App\Models\Coupon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

#[Layout('Layout.app')]
#[Title('Thêm mới danh mục bài đăng ')]
class Create extends Component
{
    use WithFileUploads;
    #[Validate()]
    public $name;
    public $value;
    public $type;
    public $quantity;
    public $startDate;
    public $endDate;
    public $status = 'public';
    public $pointRequired;
    public $priceRequired;
    public $image;

    public function render()
    {
        return view('livewire.coupon.create');
    }
    public function addNew()
    {
        $validated = $this->validate();
        do {
            $code = strtoupper(Str::random(10));
        } while (Coupon::where('code', $code)->exists());
        $qrCode = QrCode::size(100)->generate($code);
        Coupon::create([
            "name" => $validated["name"],
            "value" => $validated["value"],
            "type" => $validated['type'],
            "quantity" => $validated["quantity"],
            "start_date" => $validated["startDate"],
            "end_date" => $validated["endDate"],
            "point_required" => $validated["pointRequired"],
            "price_required" => $validated["priceRequired"],
            "code" =>  $code,
            "status" => $this->status,
            "image" => $qrCode,
        ]);
        $this->reset();
        request()->session()->flash('success', 'Thêm mới thành công');
    }
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'value' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'type' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'pointRequired' => 'required|integer|min:0',
            'priceRequired' => 'required|integer|min:0'
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
            'pointRequired.required' => 'Vui lòng nhập số điểm tối thiểu',
            'pointRequired.integer' => 'Số điểm phải là số nguyên',
            'pointRequired.min' => 'Số điểm phải lớn hơn 0',
            'priceRequired.required' => 'Vui lòng nhập số tiền tối thiểu',
            'priceRequired.integer' => 'Số tiền phải là số nguyên',
            'priceRequired.min' => 'Số tiền phải lớn hơn 0',
            'type.required' => 'Vui lòng chọn loại KM',
        ];
    }
}

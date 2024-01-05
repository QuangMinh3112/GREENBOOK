<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('Layout.app')]
#[Title('Thêm sản phẩm')]
class Index extends Component
{
    public $page = 5;
    public function render()
    {
        return view('livewire.setting.index', [
            "settings" => Setting::paginate($this->page),
        ]);
    }
}

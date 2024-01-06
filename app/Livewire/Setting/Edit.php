<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('Layout.app')]
#[Title('Chỉnh sửa hồ sơ website')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.setting.edit');
    }
}

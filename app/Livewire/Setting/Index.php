<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Hồ sơ website')]
class Index extends Component
{
    use WithPagination;

    public $page = 5;
    public function render()
    {

        return view('livewire.setting.index', [
            "settings" => Setting::paginate($this->page),
        ]);
    }
    public function delete($id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            $setting->delete();
        }
    }
    public function active($id)
    {
        $setting = Setting::find($id);
        if ($setting) {
            $setting->update([
                "is_active" => 1
            ]);
            $allSetting = Setting::where('id', '!=', $setting->id)->update(["is_active" => 0]);
        }
    }
}

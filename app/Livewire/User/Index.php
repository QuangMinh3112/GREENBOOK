<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('Layout.app')]
#[Title('Danh sách người dùng')]
class Index extends Component
{
    use WithPagination;
    public $page = 5;
    public $name = "";
    public $email = "";
    public function render()
    {
        return view('livewire.user.index', [
            'users' => User::nameSearch($this->name)
                ->emailSearch($this->email)
                ->where('role', 0)
                ->where('status', 1)
                ->paginate($this->page),
        ]);
    }
    public function lock($id)
    {
        $user = User::find($id);
        $user->update([
            'status' => 0
        ]);
        request()->session()->flash('success', 'Khoá người dùng thành công');
    }
    public function unLock($id)
    {
        $user = User::find($id);
        $user->update([
            'status' => 1
        ]);
        request()->session()->flash('success', 'Mở khoá người dùng thành công');
    }
}

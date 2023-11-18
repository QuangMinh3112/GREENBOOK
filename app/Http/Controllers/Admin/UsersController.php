<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class UsersController extends Controller

{
    private $User;
    public function __construct(User $User)
    {
        $this->User = $User;
    }
    public function index()
    {
        $User = $this->User->paginate(10);
        return view('Admin.Users.index', compact('User'));
    }

    public function create()
    {
        //
        return view('Admin.Users.create');
    }
    public function store(CreateUserRequest $request)
    {
        //
        if ($request->isMethod('POST')) {
            $User = new User();
            $User->name = $request->name;
            $User->avatar = 'fhkagfhasgh';
            $User->address = $request->address;
            $User->phone_number = $request->phone_number;
            $User->email = $request->email;
            $User->password = Hash::make($request->password);

            $User->save();
            if ($User->save()) {
                return redirect()->route('admin.user.index')->with('user.add.success', 'Thêm danh mục thành công
!!!');
            }
        }
    }
    public function delete($id)
    {
        $User = User::findOrFail($id);
        $User->delete();
        return redirect()->route('admin.user.index')->with('user.destroy.success', 'Thành công xoá danh mục');
    }
    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function edit($id)
    {
        $User = User::findOrFail($id);
        return view('Admin.Users.edit', [
            'title' => "Cập nhật thông tin danh mục",
            'User' => $User
        ]);
    }
    public function update($id, UpdateUserRequest $request)
    {
        $User = User::find($id);
        $User->name = $request->name;
        $User->avatar = 'fhkagfhasgh';
        $User->address = $request->address;
        $User->phone_number = $request->phone_number;
        $User->role = $request->role;
        $User->status = $request->status;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->save();
        return redirect()->route('admin.user.index')->with('user.update.success','Thành công cập nhật danh mục '. $User->name);
    }
}

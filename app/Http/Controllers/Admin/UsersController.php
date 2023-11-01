<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class UsersController extends Controller
    
{
    private $user;
    public function __construct(Users $user)
    {
    $this->user = $user;
}
    public function index()
    {
        $users = $this->user->paginate(10);
        return view('Admin.Users.index', compact('users'));
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
        $user = new Users();
        $user->name = $request->name;
        $user->avatar = 'fhkagfhasgh';
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        $user->save();
        if ($user->save()) {
            return redirect()->route('admin.user.index')->with('user.add.success', 'Thêm danh mục thành công 
!!!');
        }
    }
}
public function delete($id){
    $users=Users::findOrFail($id);
    $users->delete();
    return redirect()->route('admin.user.index')->with('user.destroy.success','Thành công xoá danh mục');
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
public function edit($id){
    $users=Users::findOrFail($id);
    return view('Admin.Users.edit',[
        'title'=>"Cập nhật thông tin danh mục",
        'users'=>$users
    ]);
}
public function update($id, UpdateUserRequest $request){
    $users=Users::find($id);
    $users->name=$request->name;
    $users->avatar = 'fhkagfhasgh';
    $users->address = $request->address;
    $users->phone_number = $request->phone_number;
    $users->email = $request->email;
    $users->password = Hash::make($request->password);
    $users->save();
    return redirect()->route('admin.user.index')->with('user.update.success','Thành công cập nhật danh mục '. $users->name);
}
public function archive()
{
    $archiveUser = $this->user->onlyTrashed()->paginate(10);
    return view('Admin.User.archive', compact('archiveUser'));
}
public function restore(string $id)
{
    $users = $this->user->withTrashed()->find($id);
    $users->restore();
    return back()->with('user.restore.success', 'Khôi phục danh mục thành công');
}
public function destroy(string $id)
{
    $category = $this->category->withTrashed()->find($id);
    $category->forceDelete();
    return back()->with('user.delete.success', 'Xoá vĩnh viễn danh mục thành công');
}

}


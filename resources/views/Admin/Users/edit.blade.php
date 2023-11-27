{{-- MẪU --}}
@section('title', 'Chi tiết User')
@extends('Admin.Layouts.layout')
@section('content')
<h1>Quản lý Users</h1>
<div class="col-8 mx-auto">
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h3>Chi tiết User</h3>
        </div>
        <div class="card-body">
            <div class="example"></div>
            <div class="rounded-bottom">
                <form class="p-3 active" id="preview-1000" method="POST" action="{{ route('admin.user.update',['id'=>$User->id]) }}">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="col-5 mb-3">
                            <label class="form-label">Tên Khách Hàng</label>
                            <input class="form-control" type="text" name="name" value="{{ $User->name }}">
                            @error('name')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-5 mb-3">
                            <input class="form-control" type="text" name="phone_number" value="{{ $User->phone_number }}" hidden>
                            @error('phone_number')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-5 mb-3">
                            <input class="form-control" type="text" name="address" value="{{ $User->address }}" 
                        hidden>
                            @error('address')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class=" mb-3">
                        <label class="form-label">Quyền hạng</label>
                        <select name="role" class="form-select" aria-label="Default select example">
                            <option value="0">Khách hàng</option>
                            <option value="1">Admin</option>
                        </select>
                        @error('role')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror   
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select" aria-label="Default select example">
                            <option value="0">Bị hạn chế</option>
                            <option value="1">Hoạt động</option>
                        </select>
                        @error('status')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">email </label>
                        <input name="email" class="form-control" rows="5" value="{{ $User->email }}">
                        @error('email')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-outline-success">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Sửa
                        </button>
                        <a href="" class="btn btn-outline-warning">
                            <i class="fa-solid fa-arrow-left me-2"></i>
                            Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

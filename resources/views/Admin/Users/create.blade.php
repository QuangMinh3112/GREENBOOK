{{-- MẪU --}}
@section('title', 'Form')
@extends('Admin.Layouts.layout')
@section('content')
<h1>Quản lý Users</h1>
<div class="col-8 mx-auto">
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h3>Thêm User</h3>
        </div>
        <div class="card-body">
            <div class="example"></div>
            <div class="rounded-bottom">
                <form class="p-3 active" id="preview-1000" method="POST" action="{{ route('admin.user.store') }}">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="col-5 mb-3">
                            <label class="form-label">Tên Khách Hàng</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input class="form-control" type="text" name="address" value="{{ old('address') }}">
                            @error('address')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror   
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">phone_number</label>
                        <input name="phone_number" class="form-control" rows="5">{{ old('phone_number') }} 
                        @error('phone_number')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">email </label>
                        <input name="email" class="form-control" rows="5">{{ old('email') }}
                        @error('email')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">password</label>
                        <input name="password" class="form-control" rows="5">{{ old('password') }}
                        @error('password')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>  
                    <hr>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-outline-success">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Thêm mới
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

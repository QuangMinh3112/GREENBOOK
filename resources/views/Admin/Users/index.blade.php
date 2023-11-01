{{-- MẪU --}}
@section('title', 'Danh sách người dùng')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <a href="{{ route('admin.user.create') }}" class="btn btn-success">Thêm mới</a>
                <a class="btn btn-outline-dark" href="{{ route('admin.user.archive') }}"><i class="bi bi-trash me-2"></i>Thùng rác</a>
            </div>
        </div>
        <div class="col-6">
            <div class="my-2">
                {{-- <div class="alert alert-success" role="alert">
                    Thêm sửa xoá thành công...
                </div> --}}
            </div>
        </div>
    </div>
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h2>Table</h2>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">email</th>
                                    <th scope="col">role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $data)
                                    <tr>
                                        <th>{{ $data->id }}</th>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->phone_number }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->role }}</td>
                                        <td>
                                            <!-- Nút View -->
                                            <form action="{{ route('admin.user.delete',['id'=>$data->id]) }}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button onclick="return confirm('Bạn có chắc muốn xoá tài khoản {{ $data->name }}')"  class="btn 
                                            btn-danger"><i class="bi bi-trash">Xóa</i></button>
                                                <a class="btn btn-primary" href="{{ route('admin.user.edit',['id'=>$data->id]) }}">Sửa<i class="bi 
                                            bi-pencil-square"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
























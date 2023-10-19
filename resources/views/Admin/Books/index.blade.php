{{-- MẪU --}}
@section('title', 'Danh sách sách')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <a href="{{ route('admin.category.create') }}" class="btn btn-outline-success"><i
                        class="fa-solid fa-plus"></i></a>
                <a class="btn btn-outline-dark" href=""><i class="fa-solid fa-trash"></i></i></a>

            </div>
        </div>
        <div class="col-6">
            {{-- <div class="my-2">
                <div class="alert alert-success" role="alert">
                    Thêm sửa xoá thành công...
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h2>Danh sách sách</h2>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-3">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th scope="col">Tên sách</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Giá sách</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $data)
                                    <tr>
                                        <th>{{ $data->id }}</th>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->getCategoryName($data->category_id) }}</td>
                                        <td>{{ $data->price }} VNĐ</td>
                                        <td><img src="{{ $data->image }}" alt="" height="100px"></td>
                                        <td>
                                            <!-- Nút View -->
                                            <a href="{{ route('admin.category.show', ['id' => $data->id]) }}"
                                                class="btn btn-outline-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            {{-- Sửa --}}
                                            <a class="btn btn-outline-warning"
                                                href="{{ route('admin.category.edit', ['id' => $data->id]) }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            {{-- Xoá --}}
                                            <a onclick="return confirm('Bạn có chắc không ?')"
                                                class="btn btn-outline-danger"
                                                href="{{ route('admin.category.delete', ['id' => $data->id]) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

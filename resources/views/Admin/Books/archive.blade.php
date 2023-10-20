{{-- MẪU --}}
@section('title', 'Danh sách lưu trữ')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <a class="btn btn-outline-primary" href="{{ route('admin.book.index') }}"><i class="fa-solid fa-list"></i></a>

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
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $data)
                                    <tr>
                                        <th>{{ $data->id }}</th>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->getCategoryName() }}</td>
                                        <td>{{ $data->price }} VNĐ</td>
                                        <td>

                                            <button
                                                class="
                                                @if ($data->status == 1) btn btn-success
                                                    @else
                                                    btn btn-danger @endif
                                            "
                                                disabled>{{ $data->getStatus() }}</button>
                                        </td>
                                        <td><img src="{{ asset('storage/' . $data->image) }}" alt="" height="100px">
                                        </td>
                                        <td>
                                            <!-- Nút View -->
                                            <a href="{{ route('admin.book.restore', ['id' => $data->id]) }}"
                                                class="btn btn-outline-primary">
                                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                            </a>
                                            {{-- Xoá --}}
                                            <a onclick="return confirm('Bạn có chắc không ?')"
                                                class="btn btn-outline-danger"
                                                href="{{ route('admin.book.destroy', ['id' => $data->id]) }}">
                                                <i class="fa-solid fa-circle-xmark"></i>
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

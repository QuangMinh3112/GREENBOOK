{{-- MẪU --}}
@section('title', 'Chi tiết sách')
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
            <div class="my-2">
                @if (session('category.add.success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('category.add.success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h2 class="mx-3 align-items-center">Chi tiết sách</h2>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-3">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="w-50">Từ khoá</th>
                                    <th class="w-50">Giá trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>ID</b></td>
                                    <td>{{ $book->id }}</td>
                                </tr>
                                <tr>
                                    <td><b>Tên</b></td>
                                    <td>{{ $book->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Hình ảnh</b></td>
                                    <td><img class="rounded" src="{{ asset('storage/' . $book->image) }}" width="500px"
                                            alt=""></td>
                                </tr>
                                <tr>
                                    <td><b>Giá tiền</b></td>
                                    <td>{{ $book->price }}</td>
                                </tr>
                                <tr>
                                    <td><b>Tác giả</b></td>
                                    <td>{{ $book->author }}</td>
                                </tr>
                                <tr>
                                    <td><b>Danh mục</b></td>
                                    <td>{{ $book->getCategoryName() }}</td>
                                </tr>
                                <tr>
                                    <td><b>Mô tả ngắn</b></td>
                                    <td>{{ $book->short_description }}</td>
                                </tr>
                                <tr>
                                    <td><b>Mô tả</b></td>
                                    <td>{{ $book->description }}</td>
                                </tr>
                                <tr>
                                    <td><b>Slug</b></td>
                                    <td>{{ $book->slug }}</td>
                                </tr>
                                <tr>
                                    <td><b>Nhà xuất bản</b></td>
                                    <td>{{ $book->published_company }}</td>
                                </tr>
                                <tr>
                                    <td><b>Năm xuất bản</b></td>
                                    <td>{{ $book->pushlished_year }}</td>
                                </tr>
                                <tr>
                                    <td><b>Kích thước</b></td>
                                    <td>{{ $book->width }}CM X {{ $book->height }}CM</td>
                                </tr>
                                <tr>
                                    <td><b>Số lượng</b></td>
                                    <td>{{ $book->quantity }}</td>
                                </tr>
                                <tr>
                                    <td><b>Trạng thái</b></td>
                                    <td>
                                        <button
                                            class="@if ($book->status == 1) btn btn-success @else btn btn-danger @endif"
                                            disabled>{{ $book->getStatus() }}
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Số trang</b></td>
                                    <td>{{ $book->number_of_pages }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex float-sm-end">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-warning">
                                <i class="fa-solid fa-arrow-left me-2"></i>
                                Quay lại
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

{{-- MẪU --}}
@section('title', 'Danh sách sách')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="my-2">
                <a href="{{ route('admin.book.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i></a>
                <a class="btn btn-outline-dark" href="{{ route('admin.book.archive') }}"><i
                        class="fa-solid fa-trash"></i></i></a>
            </div>
        </div>
        <div class="col-8">
            <div class="my-2">
                <form class="d-flex justify-content-end" method="POST" action="{{ route('admin.book.search') }}">
                    @csrf
                    <select class="form-select" style="width: 25%" name="category_id">
                        @include('Admin.partials.category-option')
                    </select>
                    <div class="mx-2">
                        <input type="number" name="price" class="form-control" placeholder="Giá tiền">
                    </div>
                    <select class="form-select" style="width: 25%" name="status">
                        <option selected disabled>Trạng thái</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <div class="mx-2">
                        <input type="text" name="name" class="form-control" placeholder="Tên">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
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
                                            <div class="d-flex">
                                                <!-- Nút View -->
                                                <x-button.view-btn :route="'admin.book.show'" :id="$data->id" />
                                                {{-- Sửa --}}
                                                <x-button.edit-btn :route="'admin.book.edit'" :id="$data->id" />
                                                {{-- Xoá --}}
                                                <x-button.soft-del-btn :route="'admin.book.delete'" :id="$data->id" />
                                            </div>
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

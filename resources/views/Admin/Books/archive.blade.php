{{-- MẪU --}}
@section('title', 'Danh sách lưu trữ')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <x-button.list-btn :route="'admin.book.index'" />
            </div>
        </div>
        <div class="col-6">
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
                                        <td class="d-fex">
                                            <!-- Nút khôi phục -->
                                            <x-button.restore-btn :route="'admin.book.restore'" :id="$data->id" />
                                            {{-- Xoá --}}
                                            <x-button.force-del-btn :route="'admin.book.destroy'" :id="$data->id" />
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

{{-- MẪU --}}
@section('title', 'Danh sách danh mục')
@extends('Admin.Layouts.layout')
@section('content')
<h1>Lỗi</h1>
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <a class="btn btn-outline-primary" href="{{ route('admin.user.index') }}"><i
                        class="fa-solid fa-list"></i></a>
            </div>
        </div>
        <div class="col-6">
            <div class="my-2">
                @if (session('user.add.success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('user.add.success') }}
                    </div>
                @endif
                @if (session('user.update.success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('user.update.success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h2 class="mx-3 align-items-center">Danh sách user</h2>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-3">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Danh mục cha</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($archiveCategory as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->getFullCategoryAttribute() }}</td>
                                        <td>{{ $data->limit() }}</td>
                                        <td>
                                            {{-- Khôi phục --}}
                                            <a class="btn btn-outline-success"
                                                href="{{ route('admin.user.restore', ['id' => $data->id]) }}">
                                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                            </a>
                                            {{-- Xoá --}}
                                            <a class="btn btn-outline-danger"
                                                href="{{ route('admin.user.destroy', ['id' => $data->id]) }}">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $archiveCategory->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

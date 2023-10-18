{{-- MẪU --}}
@section('title', 'Danh sách danh mục')
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
            <h2 class="mx-3 align-items-center">Chi tiết danh mục</h2>
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
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <td><b>Tên</b></td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Slug</b></td>
                                    <td>{{ $category->slug }}</td>
                                </tr>
                                <tr>
                                    <td><b>Mô tả</b></td>
                                    <td>{{ $category->description }}</td>
                                </tr>
                                <tr>
                                    <td><b>Danh mục cha</b></td>
                                    <td>{{ $category->getFullCategoryAttribute() }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex float-sm-end">
                            <a href="{{url()->previous()}}" class="btn btn-outline-warning">
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

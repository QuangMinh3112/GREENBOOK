{{-- MẪU --}}
@section('title', 'Danh sách danh mục')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <a href="{{ route('admin.category.create') }}" class="btn btn-outline-success"><i
                        class="fa-solid fa-plus"></i></a>
                <a class="btn btn-outline-dark" href="{{ route('admin.category.archive') }}"><i
                        class="fa-solid fa-trash"></i></i></a>
            </div>
        </div>
        <div class="col-6">
            <div class="my-2">
                @if (session('category.add.success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('category.add.success') }}
                    </div>
                @endif
                @if (session('category.update.success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('category.update.success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h2 class="mx-3 align-items-center">Danh sách danh mục</h2>
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
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->getFullCategoryAttribute() }}</td>
                                        <td class="d-flex">
                                            <!-- Nút View -->
                                            <x-button.view-btn :route="'admin.category.show'" :id="$data->id" />
                                            </a>
                                            {{-- Sửa --}}
                                            <x-button.edit-btn :route="'admin.category.edit'" :id="$data->id" />
                                            {{-- Xoá --}}
                                            <x-button.soft-del-btn :route="'admin.category.delete'" :id="$data->id" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

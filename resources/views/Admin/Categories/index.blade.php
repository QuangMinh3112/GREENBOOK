{{-- MẪU --}}
@section('title', 'Danh sách danh mục')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2 d-flex">
                <x-button.add-btn :route="'admin.category.create'" />
                <x-button.archive-btn :route="'admin.category.archive'" />
            </div>
        </div>
        <div class="col-6">
            <div class="my-2">
                <form class="d-flex justify-content-end" method="POST" action="{{ route('admin.category.search') }}">
                    @csrf
                    <div class="mx-2">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
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

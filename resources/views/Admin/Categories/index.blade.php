{{-- MẪU --}}
@section('title', 'Danh sách danh mục sách')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2 d-flex">
                <x-button.add-btn :route="'admin.category.create'" />
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
                        <ul>
                            @foreach ($categories as $data)
                                <li
                                    class="d-flex justify-content-between w-100 p-2 shadow-sm my-3 rounded align-items-center border">
                                    <div class="mx-3">
                                        {{ $data->name }}
                                    </div>
                                    <div class="d-flex">
                                        <!-- Nút View -->
                                        <x-button.view-btn :route="'admin.category.show'" :id="$data->id" />
                                        {{-- Sửa --}}
                                        <x-button.edit-btn :route="'admin.category.edit'" :id="$data->id" />
                                        {{-- Xoá --}}
                                        <x-button.force-del-btn :route="'admin.category.delete'" :id="$data->id" />
                                    </div>
                                </li>
                                @if (isset($data->children) && count($data->children))
                                    @include('Admin.partials.category-tree', [
                                        'children' => $data->children,
                                        'show' => 'admin.category.show',
                                        'edit' => 'admin.category.edit',
                                        'delete' => 'admin.category.delete',
                                    ])
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

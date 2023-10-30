{{-- MẪU --}}
@section('title', 'Danh sách danh mục')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <x-button.list-btn :route="'admin.category.index'" />
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
                                        <td class="d-flex">
                                            {{-- Khôi phục --}}
                                            <x-button.restore-btn :route="'admin.category.restore'" :id="$data->id" />
                                            {{-- Xoá --}}
                                            <x-button.force-del-btn :route="'admin.category.destroy'" :id="$data->id" />
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

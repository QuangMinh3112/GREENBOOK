{{-- MẪU --}}
@section('title', 'Cập nhập danh mục')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="col-8 mx-auto">
        <div class="card mb-4 shadow">
            <div class="card-header bg-dark text-white">
                <h3>Thêm danh mục mới</h3>
            </div>
            <div class="card-body">
                <div class="example"></div>
                <div class="rounded-bottom">
                    <form class="p-3 active" id="preview-1000" method="POST" action="{{ route('admin.category.update', ['id'=>$category->id]) }}">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <div class="col-5 mb-3">
                                <label class="form-label">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" value="{{ $category->name }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Danh mục cha</label>
                                <select name="parent_id" class="form-select" aria-label="Default select example">
                                    @include('Admin.partials.category-option')
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Miêu tả</label>
                            <textarea name="description" class="form-control" rows="5">{{ $category->description }}</textarea>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa-solid fa-pen me-2"></i>Cập nhật
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-warning">
                                <i class="fa-solid fa-arrow-left me-2"></i>
                                Quay lại
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

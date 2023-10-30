{{-- MẪU --}}
@section('title', 'Thêm danh mục mới')
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
                    <form class="p-3 active" id="preview-1000" method="POST" action="{{ route('admin.category.store') }}">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <div class="col-5 mb-3">
                                <label class="form-label">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
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
                            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <x-button.submit-btn :name="'Thêm mới'" />
                            <x-button.previous-btn />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

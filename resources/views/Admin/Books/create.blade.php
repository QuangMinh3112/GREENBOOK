{{-- MẪU --}}
@section('title', 'Thêm sách mới')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="col-8 mx-auto w-100">
        <div class="card mb-4 shadow">
            <div class="card-header bg-dark text-white">
                <h3>Thêm sách mới</h3>
            </div>
            <div class="card-body">
                <div class="example"></div>
                <div class="rounded-bottom">
                    <form class="p-3" method="POST" action="{{ route('admin.book.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Tên sách</label>
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="col-6 mb-3">
                                <label class="form-label">Chọn danh mục</label>
                                <select name="category_id" class="form-select" aria-label="Default select example">
                                    @include('Admin.partials.category-option')
                                </select>
                                @error('category_id')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5 mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option value="0">Inactivate</option>
                                    <option value="1">Activate</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-6">
                                <label class="form-label">Giá tiền (VNĐ)</label>
                                <input class="form-control" type="text" name="price" value="{{ old('price') }}">
                                @error('price')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <label class="form-label">Số lượng</label>
                                <input class="form-control" type="text" name="quantity" value="{{ old('quantity') }}">
                                @error('quantity')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-6">
                                <label class="form-label">Tác giả</label>
                                <input class="form-control" type="text" name="author" value="{{ old('author') }}">
                                @error('author')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <label class="form-label">Số trang</label>
                                <input class="form-control" type="text" name="number_of_pages"
                                    value="{{ old('number_of_pages') }}">
                                @error('number_of_pages')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-6 m-1">
                                <label class="form-label">Nhà xuất bản</label>
                                <input class="form-control" type="text" name="published_company"
                                    value="{{ old('published_company') }}">
                                @error('published_company')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5 m-1">
                                <label class="form-label">Năm xuất bản</label>
                                <input class="form-control" type="text" name="published_year"
                                    value="{{ old('published_year') }}">
                                @error('published_year')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-6 ">
                                <label class="form-label">Chiều dài(CM)</label>
                                <input class="form-control" type="text" name="width" value="{{ old('width') }}">
                                @error('width')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5 ">
                                <label class="form-label">Chiều rộng(CM)</label>
                                <input class="form-control" type="text" name="height" value="{{ old('height') }}">
                                @error('height')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn sách</label>
                            <textarea name="short_description" class="form-control" rows="3">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả đầy đủ</label>
                            <textarea id="editor" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-5 m-1">
                                <label class="form-label">Ảnh bìa</label>
                                <input class="form-control" type="file" name="image">
                                @error('image')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
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

{{-- MẪU --}}
@section('title', 'Chỉnh sửa bài đăng')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="col-8 mx-auto w-100">
        <div class="card mb-4 shadow">
            <div class="card-header bg-dark text-white">
                <h3>Chỉnh sửa bài đăng</h3>
            </div>
            <div class="card-body">
                <div class="example"></div>
                <div class="rounded-bottom">
                    <form class="p-3" method="POST" action="{{ route('admin.post.update', ['id' => $post->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Tiêu đề</label>
                                <input class="form-control" type="text" name="title"
                                    value="{{ old('title') ?? $post->title }}">
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
                                    <option value="Công bố">Công bố</option>
                                    <option value="Bản nháp">Bản nháp</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea id="editor" name="content" class="form-control" rows="5">{{ old('description') ?? $post->content }}</textarea>
                            @error('description')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-5 m-1">
                                <label class="form-label">Ảnh bìa</label>
                                <input class="form-control" type="file" name="image">
                                <img id="preview" src="#" alt="Preview Image" style="display:none;" />
                                @error('image')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <x-button.submit-btn :name="'Cập nhật'" />
                            <x-button.previous-btn />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

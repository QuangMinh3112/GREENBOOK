<div>
    {{-- MẪU --}}
    <div class="card mb-4 shadow">
        <div class="card-header bg-green text-white">
            <h6 class="m-0 font-weight-bold text-white">Thêm bài đăng mới</h6>
        </div>
        <div class="card-body">
            <form class="p-3" wire:submit.prevent="update">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tiêu đề</label>
                    <input class="form-control" type="text" wire:model="title">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Chọn danh mục</label>
                        <select class="form-control" wire:model="category_id">
                            @include('Admin.partials.category-option')
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select wire:model="status" class="form-control">
                            <option value="Bản nháp">Bản nháp</option>
                            <option value="Công bố">Công bố</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nội dung</label>
                    <div wire:ignore>
                        <textarea id="description" wire:model.defer="description" class="form-control" rows="5">{!! $this->description !!}</textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="formFile">Ảnh bìa cũ</label> <br>
                    <img src="{{ $oldImage }}" class="img-thumbnail" alt="..." width="300px" height="300px">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="formFile">Ảnh bìa mới</label>
                    <input class="" type="file" wire:model="image" id="formFile">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" alt="..." width="300px"
                        height="300px">
                @endif
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-block">
                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                        @if (session('success'))
                            <span class="text-success">{{ session('success') }}</span>
                        @endif
                    </div>
                    <a class="btn btn-warning" wire:navigate href="{{ route('post.index') }}">Quay lại</a>
                </div>
            </form>
        </div>
    </div>

</div>

@push('script')
    <script>
        $('#description').summernote({
            placeholder: '',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('description', contents)
                }
            }
        });
        Livewire.on('reset', () => {
            $('#description').summernote('reset');
        });
    </script>
    <script>
        Livewire.on('reset', () => {
            $('#description').summernote('code', '');
        });
    </script>
@endpush

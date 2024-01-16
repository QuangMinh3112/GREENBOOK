<div>
    {{-- MẪU --}}
    <div class="card mb-4 shadow">
        <div class="card-header bg-green text-white">
            <h6 class="m-0 font-weight-bold text-white">Thêm sản phẩm mới</h6>
        </div>
        <div class="card-body">
            <form class="p-3" wire:submit.prevent="update">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tên sách</label>
                    <input class="form-control" type="text" wire:model="name">
                    @error('name')
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
                            <option value="0">Inactivate</option>
                            <option value="1">Activate</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tác giả</label>
                        <input class="form-control" type="text" wire:model="author">
                        @error('author')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số trang</label>
                        <input class="form-control" type="text" wire:model="number_of_pages">
                        @error('number_of_pages')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Chiều dài (CM)</label>
                        <input class="form-control" type="text" wire:model="length">
                        @error('length')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Chiều rộng (CM)</label>
                        <input class="form-control" type="text" wire:model="width">
                        @error('width')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Năm xuất bản</label>
                        <input class="form-control" type="text" wire:model="published_year">
                        @error('published_year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nhà cung cấp</label>
                        <select name="" id="" class="form-control" wire:model = "supplier_id">
                            <option value="" selected>Chọn nhà cung cấp</option>
                            @foreach ($suppliers as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6 mb-3">
                        <div class="mb-3">
                            <label class="form-label">Giá nhập (VNĐ)</label>
                            <input class="form-control" type="text" wire:model="import_price">
                            @error('import_price')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá lẻ (VNĐ)</label>
                            <input class="form-control" type="text" wire:model="retail_price">
                            @error('retail_price')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá sỉ (VNĐ)</label>
                            <input class="form-control" type="text" wire:model="wholesale_price">
                            @error('wholesale_price')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mô tả ngắn sách</label>
                        <textarea wire:model="short_description" class="form-control" rows="8"></textarea>
                        @error('short_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả đầy đủ</label>
                    <div wire:ignore>
                        <textarea id="description" wire:model.defer="description" class="form-control" rows="5">{!! $product->description !!}</textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="formFile">Ảnh bìa cũ</label> <br>
                    <img src="{{ $oldImage }}" class="img-thumbnail" alt="..." width="300px"
                        height="300px">
                </div>
                <div class="mb-3">

                    <label class="form-label" for="formFile">Ảnh bìa mới</label>
                    <input class="" type="file" wire:model="image" id="formFile">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror


                </div>
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" wire:model="" class="img-thumbnail" alt="..."
                        width="300px" height="300px">
                @endif
                <hr>


                <div class="d-flex justify-content-between">
                    <div class="d-block">
                        <button class="btn btn-success" type="submit">Cập nhật</button>
                        @if (session('success'))
                            <span class="text-success">{{ session('success') }}</span>
                        @endif
                    </div>
                    <a class="btn btn-warning" wire:navigate href="{{ route('product.index') }}">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $('#description').summernote({
            placeholder: 'Hello stand alone ui',
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
@endpush

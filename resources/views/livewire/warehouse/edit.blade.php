<div class="">
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white">Thêm mới sản phẩm kho</h6>
        </div>
        <div class="card-body">
            <div class="example"></div>
            <div class="rounded-bottom">
                <form class="p-3 active" wire:submit.prevent="update">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div>
                                <div>
                                    <label class="form-label">Giá nhập (VNĐ)</label>
                                    <input class="form-control" type="text" wire:model="import_price">
                                    @error('import_price')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Giá lẻ (VNĐ)</label>
                                    <input class="form-control" type="text" wire:model="retail_price">
                                    @error('retail_price')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Giá sỉ (VNĐ)</label>
                                    <input class="form-control" type="text" wire:model="wholesale_price">
                                    @error('wholesale_price')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Số lượng trong kho</label>
                                    <input class="form-control" type="text" wire:model="quantity">
                                    @error('quantity')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Số lượng tồn kho</label>
                                    <input class="form-control" type="text" wire:model="stock">
                                    @error('stock')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Số lượng đã xuất</label>
                                    <input class="form-control" type="text" wire:model="delivery_quantity">
                                    @error('delivery_quantity')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Số lượng bị hỏng</label>
                                    <input class="form-control" type="text" wire:model="defective_quantity">
                                    @error('defective_quantity')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Số lượng trả về</label>
                                    <input class="form-control" type="text" wire:model="returned_quantity">
                                    @error('returned_quantity')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Nhà cung cấp</label>
                                    <select name="" id="" class="form-control"
                                        wire:model = "supplier_id">
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
                        </div>
                        <div class="col-md-8 mb-3">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="w-50">Từ khoá</th>
                                        <th class="w-50">Giá trị</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>ID</b></td>
                                        <td>{{ $book->id }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tên</b></td>
                                        <td>{{ $book->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Hình ảnh</b></td>
                                        <td><img class="img-thumbnail" src="{{ $book->image }}" width="300px"
                                                height="300px" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Tác giả</b></td>
                                        <td>{{ $book->author }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Danh mục</b></td>
                                        <td>{{ $book->getCategoryName() }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mô tả ngắn</b></td>
                                        <td>{{ $book->short_description }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Slug</b></td>
                                        <td>{{ $book->slug }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Năm xuất bản</b></td>
                                        <td>{{ $book->published_year }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Kích thước</b></td>
                                        <td>{{ $book->length }}CM X {{ $book->width }}CM</td>
                                    </tr>
                                    <tr>
                                        <td><b>Trạng thái</b></td>
                                        <td>
                                            <button
                                                class="@if ($book->status == 1) btn btn-success @else btn btn-danger @endif"
                                                disabled>{{ $book->getStatus() }}
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Nhà cung cấp</b></td>
                                        <td>{{ $warehouse->getSupplier() }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Giá nhập</b></td>
                                        <td>{{ $warehouse->import_price }} VNĐ</td>
                                    </tr>
                                    <tr>
                                        <td><b>Giá lẻ</b></td>
                                        <td>{{ $warehouse->retail_price }} VNĐ</td>
                                    </tr>
                                    <tr>
                                        <td><b>Giá sỉ</b></td>
                                        <td>{{ $warehouse->wholesale_price }} VNĐ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                            @if (session('success'))
                                <span class="text-success">{{ session('success') }}</span>
                            @endif
                            @error('product_id')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <a class="btn btn-warning" wire:navigate href="{{ route('warehouse.index') }}">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

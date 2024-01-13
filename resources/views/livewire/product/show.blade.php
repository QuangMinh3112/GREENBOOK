<div>
    {{-- MẪU --}}
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white ">Chi tiết sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-3">
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
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <td><b>Tên</b></td>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Hình ảnh</b></td>
                                    <td><img class="img-thumbnail" src="{{ $product->image }}" width="300px"
                                            height="300px" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Tác giả</b></td>
                                    <td>{{ $product->author }}</td>
                                </tr>
                                <tr>
                                    <td><b>Danh mục</b></td>
                                    <td>{{ $product->getCategoryName() }}</td>
                                </tr>
                                <tr>
                                    <td><b>Mô tả ngắn</b></td>
                                    <td>{{ $product->short_description }}</td>
                                </tr>
                                <tr>
                                    <td><b>Slug</b></td>
                                    <td>{{ $product->slug }}</td>
                                </tr>
                                <tr>
                                    <td><b>Năm xuất bản</b></td>
                                    <td>{{ $product->published_year }}</td>
                                </tr>
                                <tr>
                                    <td><b>Kích thước</b></td>
                                    <td>{{ $product->length }}CM X {{ $product->width }}CM</td>
                                </tr>
                                <tr>
                                    <td><b>Trạng thái</b></td>
                                    <td>
                                        <button
                                            class="@if ($product->status == 1) btn btn-success @else btn btn-danger @endif"
                                            disabled>{{ $product->getStatus() }}
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Số trang</b></td>
                                    <td>{{ $product->number_of_pages }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary" wire:navigate
                                href="{{ route('product.edit', $product->id) }}">Chỉnh sửa</a>
                            <a class="btn btn-warning" wire:navigate href="{{ route('product.index') }}">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white ">Mô tả đầy đủ</h6>
        </div>
        <div class="card-body">
            {!! $product->description !!}
        </div>
    </div>
</div>

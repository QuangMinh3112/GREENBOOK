<div class="">
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white">Thêm mới sản phẩm kho</h6>
        </div>
        <div class="card-body">
            <div class="example"></div>
            <div class="rounded-bottom">
                <form class="p-3 active" wire:submit.prevent="addNew">
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
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div>
                                <div class="row mx-auto">
                                    <div class="mb-3 mr-2">
                                        <input type="text" class="form-control" name="" id=""
                                            wire:model.live.debounce.300ms ="name" placeholder="Tìm theo tên">
                                    </div>
                                    <div class="mb-3 mr-2">
                                        <select class="form-control" name="category_id"
                                            wire:model.live.debounce.300ms='category_id'>
                                            @include('Admin.partials.category-option')
                                        </select>
                                    </div>
                                    <div class="mb-3 mr-2">
                                        <select name="" id="" class="form-control"
                                            wire:model.live.debounce.300ms = "isActivate">
                                            <option value="1" selected>Đang hoạt động</option>
                                            <option value="0">Ngừng kinh doanh</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 mr-2 align-item-center">
                                        @if (session('success'))
                                            <span class="text-success">{{ session('success') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered fs-6" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Chọn</th>
                                                <th scope="col">Tên sách</th>
                                                <th scope="col">Danh mục</th>
                                                <th scope="col">Tác giả</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Hình ảnh</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>STT</th>
                                                <th scope="col">Tên sách</th>
                                                <th scope="col">Danh mục</th>
                                                <th scope="col">Tác giả</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Hình ảnh</th>
                                            </tr>
                                        </tfoot>
                                        <tbody wire:loading.class='op-low'>
                                            @foreach ($products as $data)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                wire:model='product_id' name="flexRadioDefault"
                                                                value="{{ $data->id }}" id="flexRadioDefault1">
                                                        </div>
                                                    </td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->getCategoryName() }}</td>
                                                    <td>{{ $data->author }}</td>
                                                    <td>{{ $data->getStatus() }}</td>
                                                    <td><img class="img-thumbnail" src="{{ $data->image }}"
                                                            alt="" width="50">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="py-1 px-1">
                                    <div class="d-flex justify-content-between">
                                        <div class="flex space-x-4 items-center">
                                            <label class="w-32 text-sm font-medium text-gray-900">Hiển thị :</label>
                                            <select wire:model.live='page'
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <div class="flex space-x-4 items-center">
                                            <div class="flex items-center">
                                                {{ $products->links('Layout.livewire-pagination') }}
                                            </div>
                                            <span class="ml-4 text-sm text-gray-500">
                                                Hiển thị {{ $products->firstItem() }} - {{ $products->lastItem() }}
                                                của
                                                {{ $products->total() }} kết quả
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-success" type="submit">Thêm mới</button>
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

<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white ">Bảng</h6>
        </div>
        <div class="card-body">
            <div class="row mx-auto">
                <div class="mb-3 mr-2">
                    <input type="text" class="form-control" name="" id=""
                        wire:model.live.debounce.300ms ="name" placeholder="Tìm theo tên">
                </div>
                <div class="mb-3 mr-2">
                    <input type="text" class="form-control" name="" id=""
                        wire:model.live.debounce.300ms ="author" placeholder="Tìm tác giả">
                </div>
                <div class="mb-3 mr-2">
                    <select name="" id="" class="form-control"
                        wire:model.live.debounce.300ms = "sortOrder">
                        <option value="" selected>Không sắp xếp</option>
                        <option value="asc">Giá tiền tăng dần</option>
                        <option value="desc">Gía tiền giảm dần</option>

                    </select>
                </div>
                <div class="mb-3 mr-2">
                    <select class="form-control" name="category_id" wire:model.live.debounce.300ms='category_id'>
                        @include('Admin.partials.category-option')
                    </select>
                </div>
                <div class="mb-3 mr-2">
                    <select name="" id="" class="form-control"
                        wire:model.live.debounce.300ms = "is_activate">
                        <option value="1" selected>Đang hoạt động</option>
                        <option value="0">Ngừng kinh doanh</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th scope="col">Tên sách</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Giá sách</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th scope="col">Tên sách</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Giá sách</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->getCategoryName() }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->getStatus() }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td><img class="img-thumbnail" src="{{ $data->image }}" alt="" width="100">
                                </td>
                                <td>
                                    <button class="btn btn-primary">X</button>
                                    <button class="btn btn-danger">X</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
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
                            Hiển thị {{ $products->firstItem() }} - {{ $products->lastItem() }} của
                            {{ $products->total() }} kết quả
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

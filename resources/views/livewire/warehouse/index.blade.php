<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white ">Danh sách kho</h6>
        </div>
        <div class="card-body">
            <div class="row mx-auto">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
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
                    </div>
                    <div>
                        <button wire:click='export()' class="btn btn-success">Xuất file Excel <i
                                class="fa-sharp fa-solid fa-file-excel mx-1"></i></button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered fs-6" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Giá nhập</th>
                            <th scope="col">Giá lẻ</th>
                            <th scope="col">Giá sỉ</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Trả lại</th>
                            <th scope="col">Bị hỏng</th>
                            <th scope="col">Tồn kho</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Giá nhập</th>
                            <th scope="col">Giá lẻ</th>
                            <th scope="col">Giá sỉ</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Trả lại</th>
                            <th scope="col">Bị hỏng</th>
                            <th scope="col">Tồn kho</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody wire:loading.class='op-low'>
                        @foreach ($warehouses as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->getBookName() }}</td>
                                <td><img class="img-thumbnail" src="{{ $data->getBookImage() }}" alt=""
                                        width="100">
                                </td>
                                <td>{{ $data->import_price }} VNĐ</td>
                                <td>{{ $data->retail_price }} VNĐ</td>
                                <td>{{ $data->wholesale_price }} VNĐ</td>
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->returned_quantity }}</td>
                                <td>{{ $data->defective_quantity }}</td>
                                <td>{{ $data->stock }}</td>
                                <td class="">
                                    <div class="d-flex">
                                        <a class="mx-2 text-success" wire:navigate
                                            href="{{ route('warehouse.edit', ['id' => $data->id]) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
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
                            {{ $warehouses->links('Layout.livewire-pagination') }}
                        </div>
                        <span class="ml-4 text-sm text-gray-500">
                            Hiển thị {{ $warehouses->firstItem() }} - {{ $warehouses->lastItem() }} của
                            {{ $warehouses->total() }} kết quả
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<div class="">
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white">Tạo mới đơn hàng</h6>
        </div>
        <div class="card-body">
            <div class="example"></div>
            <div class="rounded-bottom">
                <form class="p-3 active" wire:submit.prevent="addNew">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên người mua</label>
                            <input class="form-control" type="text" wire:model="name">
                            @error('name')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input class="form-control" type="text" wire:model="phone_number">
                            @error('phone_number')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="text" wire:model="email">
                            @error('name')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thanh toán</label>
                            <select name="" id="" class="form-control" wire:model='payment'>
                                <option value="" selected>Chọn phương thức thanh toán</option>
                                <option value="Paid">Chuyển khoản</option>
                                <option value="COD">Tiền mặt</option>
                            </select>
                            @error('name')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Chọn sản phẩm</label>
                            <div class="row mx-auto">
                                <div class="mb-3 mr-2">
                                    <input type="text" class="form-control" name="" id=""
                                        wire:model.live.debounce.300ms ="searchName" placeholder="Tìm theo tên">
                                </div>
                                <div class="mb-3 mr-2">
                                    <select class="form-control" name="category_id"
                                        wire:model.live.debounce.300ms='category_id'>
                                        @include('Admin.partials.category-option')
                                    </select>
                                </div>
                            </div>
                            <div>
                                <table class="table table-bordered fs-6" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Chọn</th>
                                            <th scope="col">Tên sách</th>
                                            <th scope="col">Danh mục</th>
                                            <th scope="col">Giá tiền</th>
                                            <th scope="col">Hình ảnh</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Chọn</th>
                                            <th scope="col">Tên sách</th>
                                            <th scope="col">Danh mục</th>
                                            <th scope="col">Giá tiền</th>
                                            <th scope="col">Hình ảnh</th>
                                        </tr>
                                    </tfoot>
                                    <tbody wire:loading.class='op-low'>
                                        @foreach ($books as $data)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model='book_id' name="flexRadioDefault"
                                                            value="{{ $data->id }}" id="flexRadioDefault1">
                                                    </div>
                                                </td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->getCategoryName() }}</td>
                                                <td>{{ $data->warehouse->retail_price }} VNĐ</td>
                                                <td><img class="img-thumbnail" src="{{ $data->image }}" alt=""
                                                        width="50">
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
                                            {{ $books->links('Layout.livewire-pagination') }}
                                        </div>
                                        <span class="ml-4 text-sm text-gray-500">
                                            Hiển thị {{ $books->firstItem() }} - {{ $books->lastItem() }}
                                            của
                                            {{ $books->total() }} kết quả
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label mt-5">Sản phẩm đã chọn</label>
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Giá tiền</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Số lượng kho</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Giá tiền</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Số lượng kho</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if ($selectedBook != null)
                                        @foreach ($selectedBook as $key => $data)
                                            <tr>
                                                <td>{{ $data['name'] }}</td>
                                                <td><img class="img-thumbnail" width="50"
                                                        src="{{ $data['image'] }}" alt="">
                                                </td>
                                                <td>
                                                    @if ($data['quantity'] < 20)
                                                        {{ $data['price'] }}
                                                    @else
                                                        {{ $data['wholesale_price'] }}
                                                    @endif
                                                    VNĐ
                                                </td>
                                                <td><input class="form-control form-control-sm" type="text"
                                                        wire:model='selectedBook.{{ $key }}.quantity'
                                                        placeholder="Số lượng"></td>
                                                <td>{{ $data['quantity_old'] }}</td>
                                                <td>
                                                    <button class="btn btn-danger"
                                                        wire:click.prevent='delete({{ $data['id'] }})'>Xoá</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div>Tổng tiền : {{ $total }} VNĐ</div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="">
                            <button wire:click.prevent='addBook()' class="btn btn-primary mx-2">Thêm sản phẩm</button>
                        </div>
                        <div class="">
                            <button wire:click.prevent='updateTotal()' class="btn btn-primary mx-2">Cập nhật</button>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-success" type="submit">Tạo mới đơn hàng</button>
                            @if (session('success'))
                                <span class="text-success">{{ session('success') }}</span>
                            @endif
                            @if (session('fail'))
                                <span class="text-danger">{{ session('fail') }}</span>
                            @endif
                        </div>
                        <a class="btn btn-warning" wire:navigate href="{{ route('order.index') }}">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

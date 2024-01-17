<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white ">Danh sách đơn hàng</h6>
        </div>
        <div class="card-body">
            <div class="row mx-auto">
                <div class="mb-3 mr-2">
                    <input type="text" class="form-control" name="" id=""
                        wire:model.live.debounce.300ms ="order_code" placeholder="Tìm theo mã đơn hàng">
                </div>
                <div class="mb-3 mr-2">
                    <select name="" id="" class="form-control"
                        wire:model.live.debounce.300ms = "status">
                        <option value="" selected>Trạng thái đơn hàng</option>
                        <option value="pending">Chờ xác nhận</option>
                        <option value="confirmed">Đã xác nhận</option>
                        <option value="shipping">Đang giao</option>
                        <option value="completed">Hoàn thành</option>
                        <option value="failed">Thất bại</option>
                        <option value="cancel">Đã huỷ</option>
                        <option value="refund">Trả hàng</option>
                    </select>
                </div>
                <div class="mb-3 mr-2">
                    <select name="" id="" class="form-control"
                        wire:model.live.debounce.300ms = "payment">
                        <option value="" selected>Tất cả</option>
                        <option value="COD">Thanh toán khi nhận hàng</option>
                        <option value="Waiting">Chờ thanh toán</option>
                        <option value="Paid">Đã thanh toán</option>
                    </select>
                </div>
                <div class="mb-3 mr-2">
                    <select name="" id="" class="form-control"
                        wire:model.live.debounce.300ms = "sortDate">
                        <option value="" selected>Ngày đặt</option>
                        <option value="asc">Cũ nhất</option>
                        <option value="desc">Mới nhất</option>
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
                            <th scope="col">Order Code</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Tên người đặt</th>
                            <th scope="col">Tổng tiền đơn hàng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Ngày đặt hàng</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th scope="col">Order Code</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Tên người đặt</th>
                            <th scope="col">Tổng tiền đơn hàng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Ngày đặt hàng</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody wire:loading.class='op-low'>
                        @if (count($orders) > 0)
                            @foreach ($orders as $data)
                                <tr>
                                    <td scope="col">{{ $data->order_code }}</td>
                                    <td scope="col">{{ $data->payment }}</td>
                                    <td scope="col">{{ $data->name }}</td>
                                    <td scope="col">{{ $data->total }} VNĐ</td>
                                    <td scope="col">{{ $data->status }}</td>
                                    <td scope="col">{{ $data->address }}</td>
                                    <td scope="col">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td scope="col">
                                        <a wire:navigate href="{{ route('order.show', ['id' => $data->id]) }}"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="8">Không có dữ liệu</td>
                            </tr>
                        @endif
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
                            {{ $orders->links('Layout.livewire-pagination') }}
                        </div>
                        <span class="ml-4 text-sm text-gray-500">
                            Hiển thị {{ $orders->firstItem() }} - {{ $orders->lastItem() }} của
                            {{ $orders->total() }} kết quả
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

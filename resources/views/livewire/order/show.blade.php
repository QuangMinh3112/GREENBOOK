<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white ">Chi tiết đơn hàng</h6>
        </div>
        <div class="card-body">
            <div class="row mx-auto">
                <div class="mb-3 mr-2 align-item-center">

                </div>
            </div>
            <div class="col-12 d-flex">
                <div class="col-4">
                    <div class="h-100 w-100">
                        <div class="container h-100">
                            <div class="row d-flex h-100">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="fw-normal mb-0 text-black">
                                            Thông tin người đặt hàng
                                        </h4>
                                    </div>
                                    <div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item justify-content-between d-flex">
                                                <div>
                                                    <b>Họ và tên:</b>
                                                </div>
                                                <div>
                                                    {{ $order->name }}
                                                </div>
                                            </li>
                                            <li class="list-group-item justify-content-between d-flex">
                                                <div>
                                                    <b>Số điện thoại:</b>
                                                </div>
                                                <div>
                                                    {{ $order->phone_number }}
                                                </div>
                                            </li>
                                            <li class="list-group-item justify-content-between d-flex">
                                                <div>
                                                    <b>Địa chỉ: </b>
                                                </div>
                                                <div>
                                                    {{ $order->address }}
                                                </div>
                                            </li>
                                            <li class="list-group-item justify-content-between d-flex">
                                                <div>
                                                    <b>Thanh toán:</b>
                                                </div>
                                                <div>
                                                    {{ $order->payment }}
                                                </div>
                                            </li>
                                            <li class="list-group-item justify-content-between d-flex">
                                                <div>
                                                    <b>Trạng thái đơn hàng:</b>
                                                </div>
                                                <div>
                                                    {{ $order->status }}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="justify-content-between d-flex my-3">
                                        @if ($order->status === 'Chờ xử lý')
                                            <div>
                                                <button class="btn btn-success" wire:click='approve()'>Xác nhận đơn
                                                    hàng</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary" wire:click.prevent='update()'>Cập
                                                    nhật</button>
                                            </div>
                                            <div>
                                                <button wire:click='cancel()' class="btn btn-danger">Huỷ đơn hàng</button>
                                            </div>
                                        @elseif ($order->status === 'Đã xác nhận')
                                            <div>
                                                <button class="btn btn-success" wire:click='shipping()'>Bắt đầu giao
                                                    hàng</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-danger" wire:click='cancel()'>Huỷ đơn
                                                    hàng</button>
                                            </div>
                                        @elseif ($order->status === 'Đang giao')
                                            <div>
                                                <button class="btn btn-success btn-sm" wire:click='completed()'>Đã nhận
                                                    hàng</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary btn-sm" wire:click='defective()'>Trả
                                                    hàng</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-danger btn-sm" wire:click='returned()'>Không
                                                    nhận
                                                    hàng</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-warning btn-sm" wire:click='defective()'>Đơn hàng
                                                    lỗi</button>
                                            </div>
                                        @endif
                                    </div>
                                    @if (session('success'))
                                        <span class="text-success">{{ session('success') }}</span>
                                    @endif
                                    @if (session('fail'))
                                        <span class="text-danger">{{ session('fail') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-8">
                    <div class="h-100 w-100">
                        <div class="container h-100">
                            <div class="row d-flex h-100">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="fw-normal mb-0 text-black">Các sản phẩm đơn hàng
                                            {{ $order->order_code }}
                                        </h4>
                                        <div>
                                            <i>Ngày đặt hàng :
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</i>
                                        </div>
                                    </div>

                                    @foreach ($orderDetail as $data)
                                        <div class="card rounded-3 mb-4">
                                            <div class="card-body p-4">
                                                <div class="row d-flex justify-content-between align-items-center">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <img src="{{ $data->book_image }}" class="img-fluid rounded-3"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <p class=" mb-2">{{ $data->book_name }}</p>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                        <input type="text" class="form-control"
                                                            wire:model.defer="quantity.{{ $data->id }}">
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <small class="mb-0">{{ $data->quantity * $data->book_price }}
                                                            VNĐ
                                                        </small>
                                                        <br>
                                                        @if ($data->warehouse->quantity >= $data->quantity)
                                                            <small class="text-success">Còn hàng ( SL:
                                                                {{ $data->warehouse->quantity }} )
                                                                {{ $data->book->quantity }}</small>
                                                        @elseif ($data->warehouse->quantity == 0)
                                                            <small class="text-danger">Hết hàng</small>
                                                        @else
                                                            <small class="text-warning">Thiếu
                                                                {{ $data->quantity - $data->warehouse->quantity }}</small>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                        @if ($order->status === 'Chờ xử lý')
                                                            <a class="text-danger"
                                                                wire:click.live='delete({{ $data->id }})'>
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <b class="fw-normal mb-0 text-black">Phí vận chuyển :
                                        </b>
                                        <div>
                                            {{ $order->ship_fee }} VNĐ
                                        </div>
                                    </div>
                                    @if ($usingCoupon != null)
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <b class="fw-normal mb-0 text-black">Mã giảm giá :
                                            </b>
                                            <div>
                                                @if ($usingCoupon->coupon->type === 'percent')
                                                    -{{ $usingCoupon->coupon->value }} %
                                                @elseif ($usingCoupon->coupon->type === 'number')
                                                    -{{ $usingCoupon->coupon->value }} VNĐ
                                                @elseif ($usingCoupon->coupon->type === 'free_ship')
                                                    FREE SHIP
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="fw-normal mb-0 text-black">Tổng tiền :
                                        </h5>
                                        <div>
                                            {{ $order->total }} VNĐ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>



</div>

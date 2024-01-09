<div class="card mb-4 shadow">
    <div class="card-header py-3 bg-green">
        <h6 class="m-0 font-weight-bold text-white">Tặng mã giảm giá</h6>
    </div>
    <div class="card-body">
        <div class="row mx-auto justify-content-center">
            <div class="col-12 mx-auto">
                <h3 class="text-center">
                    Chọn mã giảm giá để tặng
                </h3>
                <div class="d-flex">
                    <div class="col-6 mx-auto my-3 d-flex">
                        <div class="form-float w-100">
                            <select class="form-control form-select-lg mb-3 custom-select"
                                wire:model.prevent='coupon_id'>
                                <option selected>Chọn mã giảm giá</option>
                                @foreach ($coupon_privates as $data)
                                    <option value="{{ $data->id }}"> {!! $data->image !!} {{ $data->name }} -
                                        @if ($data->type === 'free_ship')
                                            Free Ship
                                        @elseif ($data->type === 'percent')
                                            Giảm {{ $data->value }} %
                                        @else
                                            Giảm {{ $data->value }} VNĐ
                                        @endif
                                        - Số lượng : {{ $data->quantity }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mx-3">
                            <button class="btn btn-success" wire:click='giveAway'><i
                                    class="fa-solid fa-gift"></i></button>
                        </div>
                    </div>

                </div>
                <div class="">
                    <div class="row mx-auto">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="mb-3 mr-2">
                                    <input type="text" class="form-control" name="" id=""
                                        wire:model.live.debounce.300ms ="name" placeholder="Tìm theo tên">
                                </div>
                                <div class="mb-3 mr-2">
                                    <input type="text" class="form-control" name="" id=""
                                        wire:model.live.debounce.300ms ="email" placeholder="Tìm theo email">
                                </div>
                                <div class="mb-3 mr-2">
                                    @if (session('fail'))
                                        <span class="mx-auto text-danger">{{ session('fail') }}</span>
                                    @endif
                                    @if (session('success'))
                                        <span class="mx-auto text-success">{{ session('success') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Chọn</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền hạn</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Điểm</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Chọn</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền hạn</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Điểm</th>
                            </tr>
                        </tfoot>
                        <tbody wire:loading.class='op-low'>
                            @foreach ($users as $data)
                                <tr>
                                    <td><input type="checkbox" value="{{ $data->id }}" wire:model='userList'>
                                    </td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                        @if ($data->role == 0)
                                            <button class="btn btn-primary" disabled>Khách hàng</button>
                                        @elseif ($data->role == 1)
                                            <button class="btn btn-success" disabled>Quản trị</button>
                                        @else
                                            <button class="btn btn-success" disabled>Nhân viên</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->status == 1)
                                            <button class="btn btn-success" disabled>Hoạt động</button>
                                        @else
                                            <button class="btn btn-danger" disabled>Bị khoá</button>
                                        @endif
                                    </td>
                                    <td>{{ $data->point }} điểm</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                                    {{ $users->links('Layout.livewire-pagination') }}
                                </div>
                                <span class="ml-4 text-sm text-gray-500">
                                    Hiển thị {{ $users->firstItem() }} - {{ $users->lastItem() }} của
                                    {{ $users->total() }} kết quả
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="example">
            <div class="rounded-bottom">
                <div class="">
                </div>
            </div>
        </div>
    </div>
</div>

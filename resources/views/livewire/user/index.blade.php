<div class="card mb-4 shadow">
    <div class="card-header py-3 bg-green">
        <h6 class="m-0 font-weight-bold text-white ">Danh sách người dùng</h6>
    </div>
    <div class="card-body">
        <div class="example">
            <div class="rounded-bottom">
                <div class="">
                    <div class="row mx-auto">
                        <div class="mb-3 mr-2">
                            <input type="text" class="form-control" name="" id=""
                                wire:model.live.debounce.300ms ="name" placeholder="Tìm theo tên">
                        </div>
                        <div class="mb-3 mr-2">
                            <input type="text" class="form-control" name="" id=""
                                wire:model.live.debounce.300ms ="email" placeholder="Tìm theo email">
                        </div>
                        <div class="mb-3 mr-2">
                            <select name="" id="" class="form-control"
                                wire:model.live.debounce.300ms = "role">
                                <option value="0" selected>Khách hàng</option>
                                <option value="2">Nhân viên</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3 mr-2">
                            <select name="" id="" class="form-control"
                                wire:model.live.debounce.300ms = "status">
                                <option value="1" selected>Đang hoạt động</option>
                                <option value="0">Bị khoá</option>
                            </select>
                        </div>
                        <div class="mb-3 mr-2 align-item-center">
                            @if (session('success'))
                                <span class="text-success">{{ session('success') }}</span>
                            @endif
                        </div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền hạn</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Điểm</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền hạn</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Điểm</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody wire:loading.class='op-low'>
                            @foreach ($users as $data)
                                <tr>
                                    <th>{{ $data->id }}</th>
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
                                    <td>
                                        <div class="d-flex">
                                            {{-- Xem hồ sơ người dùng --}}
                                            {{-- Sửa --}}
                                            <a class="mx-2 text-success" href="{{ route('user.edit', $data->id) }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            {{-- Ngừng hoạt động --}}
                                            @if ($data->status != 0)
                                                <a wire:click.prevent="lock({{ $data->id }})"
                                                    class="mx-2 text-danger"><i class="fa-solid fa-lock"></i></a>
                                            @else
                                                <a wire:click.prevent="unLock({{ $data->id }})" class="mx-2"><i
                                                        class="fa-solid fa-unlock"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white ">Danh sách nhà cung cấp</h6>
        </div>
        <div class="card-body">
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
                    @if (session('success'))
                        <span class="text-success">{{ session('success') }}</span>
                    @endif
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered fs-6" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Số Fax</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Số Fax</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody wire:loading.class='op-low'>
                        @foreach ($suppliers as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $data->phone_number }}</td>
                                <td>{{ $data->fax }}</td>
                                <td class="">
                                    <div class="d-flex">
                                        <a class="mx-2 text-success" wire:navigate
                                            href="{{ route('suppliers.edit', ['id' => $data->id]) }}"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="mx-2 text-danger" wire:click="delete({{ $data->id }})"><i
                                                class="fa-solid fa-trash"></i></a>
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
                            {{ $suppliers->links('Layout.livewire-pagination') }}
                        </div>
                        <span class="ml-4 text-sm text-gray-500">
                            Hiển thị {{ $suppliers->firstItem() }} - {{ $suppliers->lastItem() }} của
                            {{ $suppliers->total() }} kết quả
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

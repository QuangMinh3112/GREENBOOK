<div class="card mb-4 shadow">
    <div class="card-header py-3 bg-green">
        <h6 class="m-0 font-weight-bold text-white">Danh sách bài đăng</h6>
    </div>
    <div class="card-body">
        <div class="row mx-auto">
            <div class="mb-3 mr-2">
                <input type="text" class="form-control" name="" id=""
                    wire:model.live.debounce.300ms ="title" placeholder="Tìm theo tên">
            </div>
            <div class="mb-3 mr-2">
                <select class="form-control" name="category_id" wire:model.live.debounce.300ms='category_id'>
                    @include('Admin.partials.category-option')
                </select>
            </div>
            <div class="mb-3 mr-2">
                <select name="" id="" class="form-control" wire:model.live.debounce.300ms = "status">
                    <option value="Công bố" selected>Công bố</option>
                    <option value="Bản nháp">Bản nháp</option>
                </select>
            </div>
            <div class="mb-3 mr-2 align-item-center">
                @if (session('success'))
                    <span class="text-success">{{ session('success') }}</span>
                @endif
            </div>
        </div>
        <div class="example">
            <div class="rounded-bottom">
                <div class="">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th scope="col">Tên bài</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th scope="col">Tên bài</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody wire:loading.class='op-low'>
                            @if (count($posts) > 0)
                                @foreach ($posts as $data)
                                    <tr>
                                        <th>{{ $data->id }}</th>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->getCategoryName() }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td><img class="img-thumbnail" src="{{ $data->image }}" alt=""
                                                width="100">
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a wire:navigate class="text-secondary mx-2"
                                                    href="{{ route('post.show', $data->id) }}"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <a class="text-success mx-2" wire:navigate
                                                    href="{{ route('post.edit', $data->id) }}"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                @if ($status === 'Công bố')
                                                    <a class="mx-2 text-secondary"
                                                        wire:click="draft({{ $data->id }})">
                                                        <i class="fa-solid fa-floppy-disk"></i>
                                                    </a>
                                                @else
                                                    <a class="mx-2 text-secondary"
                                                        wire:click="published({{ $data->id }})">
                                                        <i class="fa-solid fa-upload"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="6">Không tìm thấy dữ liệu</td>
                                </tr>
                            @endif
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
                        {{ $posts->links('Layout.livewire-pagination') }}
                    </div>
                    <span class="ml-4 text-sm text-gray-500">
                        Hiển thị {{ $posts->firstItem() }} - {{ $posts->lastItem() }} của
                        {{ $posts->total() }} kết quả
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

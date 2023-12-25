<div class="card mb-4 shadow">
    <div class="card-header py-3 bg-green">
        <h6 class="m-0 font-weight-bold text-white">Danh sách danh mục</h6>
    </div>
    <div class="card-body">
        <div class="example">
            <div class="rounded-bottom">
                @if (session('success'))
                    <span class="text-success">{{ session('success') }}</span>
                @endif
                @if (session('warn'))
                    <span class="text-danger">{{ session('warn') }}</span>
                @endif
                <div class="">
                    <ul>
                        @foreach ($categories as $data)
                            <li
                                class="d-flex justify-content-between w-100 p-2 shadow-sm my-3 rounded align-items-center border">
                                <div class="mx-3">
                                    {{ $data->name }}
                                </div>
                                <div class="d-flex">
                                    <!-- Nút View -->
                                    <a wire:navigate href="{{ route('category.show', $data->id) }}" class="mx-2 text-secondary"><i
                                            class="fa-solid fa-eye"></i></a>
                                    {{-- Sửa --}}
                                    <a wire:navigate href="{{ route('category.edit', $data->id) }}"
                                        class="mx-2 text-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                    {{-- Xoá --}}
                                    <a href="" class="mx-2 text-danger"
                                        wire:click.prevent="delete({{ $data->id }})"><i
                                            class="fa-solid fa-trash"></i></a>
                                </div>
                            </li>

                            @if (isset($data->children) && count($data->children))
                                @include('Admin.partials.category-tree', [
                                    'children' => $data->children,
                                ])
                            @endif
                        @endforeach
                    </ul>
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
                        {{ $categories->links('Layout.livewire-pagination') }}
                    </div>
                    <span class="ml-4 text-sm text-gray-500">
                        Hiển thị {{ $categories->firstItem() }} - {{ $categories->lastItem() }} của
                        {{ $categories->total() }} kết quả
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

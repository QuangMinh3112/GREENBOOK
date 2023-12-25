<div class="card mb-4 shadow">
    <div class="card-header py-3 bg-green">
        <h6 class="m-0 font-weight-bold text-white">Chi tiết danh mục</h6>
    </div>
    <div class="card-body">
        <div class="example">
            <div class="rounded-bottom">
                <div class="p-3">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="w-50">Từ khoá</th>
                                <th class="w-50">Giá trị</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>ID</b></td>
                                <td>{{ $category->id }}</td>
                            </tr>
                            <tr>
                                <td><b>Tên</b></td>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <td><b>Slug</b></td>
                                <td>{{ $category->slug }}</td>
                            </tr>
                            <tr>
                                <td><b>Mô tả</b></td>
                                <td>{{ $category->description }}</td>
                            </tr>
                            <tr>
                                <td><b>Danh mục cha</b></td>
                                <td>{{ $category->getFullCategoryAttribute() }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <a wire:navigate href="{{ route('category.edit', $category->id) }}"
                            class="btn btn-primary">Chỉnh sửa</a>
                        <x-button.previous-btn />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

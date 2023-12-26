<div class="">
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white">Chỉnh sửa danh mục</h6>
        </div>
        <div class="card-body">
            <div class="example"></div>
            <div class="rounded-bottom">
                <form class="p-3 active" wire:submit.prevent="update">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input class="form-control" type="text" wire:model="name">
                            @error('name')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select class="form-control" wire:model="parent_id">
                                @include('Admin.partials.category-option')
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Miêu tả</label>
                        <textarea wire:model="description" class="form-control" rows="5"></textarea>
                        @error('description')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                            @if (session('success'))
                                <span class="text-success">{{ session('success') }}</span>
                            @endif
                        </div>

                        <a class="btn btn-warning" wire:navigate href="{{ route('category.index') }}">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

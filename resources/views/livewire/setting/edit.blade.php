<div class="">
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white">chỉnh sửa hồ sơ website</h6>
        </div>
        <div class="card-body">
            <div class="example"></div>
            <div class="rounded-bottom">
                <form class="p-3 active" wire:submit.prevent="update">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên website</label>
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
                            @error('email')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input class="form-control" type="text" wire:model="address">
                            @error('address')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label class="form-label" for="formFile">Ảnh LOGO cũ</label> <br>
                                <img src="{{ $oldLogo }}" class="img-thumbnail" alt="..." width="300px"
                                    height="300px">
                            </div>
                            <div>
                                <label class="form-label" for="formFile">Ảnh LOGO</label> <br>
                                <input class="" type="file" wire:model="logo" id="formFile">
                                <div class="mt-3">
                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" class="img-thumbnail" alt="..."
                                            width="300px" height="300px">
                                    @endif
                                </div>
                                <br>
                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng thái</label> <br>
                            <select wire:model="is_active" class="form-control">
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-success" type="submit">Cập nhật</button>
                            @if (session('success'))
                                <span class="text-success">{{ session('success') }}</span>
                            @endif
                        </div>
                        <a class="btn btn-warning" wire:navigate href="{{ route('setting.index') }}">Quay lại</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

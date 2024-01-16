<div class="">
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white">Thêm mới nhà cung cấp</h6>
        </div>
        <div class="card-body">
            <div class="example"></div>
            <div class="rounded-bottom">
                <form class="p-3 active" wire:submit.prevent="addNew">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Tên nhà cung cấp</label>
                            <input class="form-control" type="text" wire:model="name">
                            @error('name')
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
                            <label class="form-label">Số điện thoại</label>
                            <input class="form-control" type="text" wire:model="phone_number">
                            @error('phone_number')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số FAX</label>
                            <input class="form-control" type="text" wire:model="fax">
                            @error('fax')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-success" type="submit">Thêm mới</button>
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

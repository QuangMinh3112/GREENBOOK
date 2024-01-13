<div class="col-12 mx-auto">
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white">Nhập kho</h6>
        </div>
        <div class="card-body">
            <form wire:submit.prevent='addNew()' >
                <div class="form-group">
                    <label for="name">Mã nhập kho:</label>
                    <input type="text" class="form-control" wire:model="code">
                    @error('code')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-floating">
                        <label for="floatingTextarea2">Nội dung:</label>
                        <textarea class="form-control" id="floatingTextarea2" style="height: 100px" wire:model='description'></textarea>
                    </div>
                    @error('description')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Ghi chú:</label>
                    <input type="text" class="form-control" wire:model="note">
                    @error('note')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <label class="form-label">Dữ liệu nhập vào</label>
                    <button class="btn btn-success" wire:click.prevent="addField({{ $key }})">Thêm sản
                        phẩm</button>
                </div>
                @foreach ($inputs as $key => $value)
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sản phẩm</label>
                            <select wire:model="product_id.{{ $value }}"
                                wire:change='updateImportPrice({{ $value }})' class="form-control">
                                <option value="0" selected>Chọn sản phẩm</option>
                                @foreach ($books as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->name }} -
                                        @if ($data->status == 0)
                                            Ngừng hoạt động
                                        @else
                                            Hoạt động
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">Số lượng</label>
                            <input class="form-control" type="text" wire:model="quantity.{{ $value }}"
                                wire:change='updateTotalPrice({{ $value }})'>
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Giá nhập</label>
                            <input class="form-control" type="text" wire:model="import_price.{{ $value }}"
                                disabled>
                            @error('import_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Tổng tiền nhập</label>
                            <input class="form-control" type="text" wire:model="total.{{ $value }}" disabled>
                            @error('total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-1 mb-2">
                            <label class="invisible">Hidden Label</label>
                            <button wire:click.prevent="removeField({{ $key }})"
                                class="btn btn-danger">Xoá</button>
                        </div>
                    </div>
                @endforeach
                <hr>
                <div class="form-group d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        @if (session('success'))
                            <span class="text-success">{{ session('success') }}</span>
                        @endif
                    </div>
                    <x-button.previous-btn></x-button.previous-btn>
                </div>
            </form>
        </div>
    </div>
</div>

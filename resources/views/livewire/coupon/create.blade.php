<div class="col-8 mx-auto">
    <div class="card mb-4 shadow">
        <div class="card-header py-3 bg-green">
            <h6 class="m-0 font-weight-bold text-white">Thêm mã giảm giá</h6>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="addNew">
                <div class="form-group">
                    <label for="name">Tên mã giảm giá:</label>
                    <input type="text" class="form-control" id="name" wire:model="name">
                    @error('name')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="value">Giá trị:</label>
                    <input type="text" class="form-control" id="value" wire:model="value">
                    @error('value')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Loại hình KM:</label>
                    <select class="form-control" wire:model="type">
                        <option selected value="percent">Chọn loại KM</option>
                        <option value="percent">Phần trăm</option>
                        <option value="number">Giá tiền</option>
                        <option value="free_ship">Free ship</option>
                    </select>
                    @error('type')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Trạng thái:</label>
                    <select class="form-control" wire:model="status">
                        <option selected value="public">Công khai</option>
                        <option value="private">Riêng tư</option>
                    </select>
                    @error('type')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng:</label>
                    <input type="number" class="form-control" id="quantity" wire:model="quantity">
                    @error('quantity')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_date">Ngày bắt đầu:</label>
                    <input id="start_date" class="form-control" type="text" wire:model="startDate"
                        onfocus="(this.type='datetime-local')" onblur="(this.type='text')" />
                </div>
                @error('startDate')
                    <span class="text-danger fst-italic">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="end_date">Ngày kết thúc:</label>
                    <input id="end_date" class="form-control" type="text" wire:model="endDate"
                        onfocus="(this.type='datetime-local')" onblur="(this.type='text')" />
                </div>
                @error('endDate')
                    <span class="text-danger fst-italic">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="point_required">Điểm tối thiểu:</label>
                    <input type="number" class="form-control" id="point_required" wire:model="pointRequired">
                    @error('pointRequired')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="point_required">Giá tiền tối thiểu:</label>
                    <input type="number" class="form-control" id="point_required" wire:model="priceRequired">
                    @error('pointRequired')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
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

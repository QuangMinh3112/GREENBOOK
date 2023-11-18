{{-- MẪU --}}
@section('title', 'Thêm danh mục bài đăng mới')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="col-8 mx-auto">
        <div class="card mb-4 shadow">
            <div class="card-header bg-dark text-white">
                <h3>Thêm danh mục bài đăng mới</h3>
            </div>
            <div class="card-body">
                <div class="example"></div>
                <div class="rounded-bottom">
                    <form class="p-3 active" id="preview-1000" method="POST" action="{{ route('admin.coupon.store') }}">
                        @csrf
                        <div class="d-flex text-nowrap justify-content-between">
                            <div class="col-8 mb-3">
                                <label class="form-label">Code giảm giá</label>
                                <div class="d-flex justify-content-between">
                                    <input class="form-control" type="text" name="code" id="code"
                                        value="{{ old('code') }}">
                                    @error('code')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                    <div class="btn btn-outline-success mx-2" onclick="createCoupon()"><b>Tạo
                                            code</b></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option selected value="Public">Công khai</option>
                                    <option value="Private">Riêng tư</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="col-6">
                                <label class="form-label">Giá trị giảm giá</label>
                                <div class="d-flex">
                                    <div class="col-9">
                                        <input type="text" class="form-control" name="discount">
                                    </div>
                                    <div class="col-3 mx-3">
                                        <select class="form-select" aria-label="Default select example" name="value">
                                            <option selected value="percent">%</option>
                                            <option value="number">VNĐ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <label class="form-label">Ngày hết hạn</label>
                                <input type="date" class="form-control" name="end_time">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" id="floatingTextarea" name="description"></textarea>
                                <label for="floatingTextarea">Miêu tả</label>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <x-button.submit-btn :name="'Thêm mới'" />
                            <x-button.previous-btn />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<script>
    function createCoupon() {
        var randomCode = Math.random().toString(36).substring(2, 10).toUpperCase();
        document.getElementById('code').value = randomCode;
    }
</script>

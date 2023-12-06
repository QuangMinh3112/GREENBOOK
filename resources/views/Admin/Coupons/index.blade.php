{{-- MẪU --}}
@section('title', 'Danh sách bài đăng')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="my-2 d-flex">
                <x-button.add-btn :route="'admin.coupon.create'" />
            </div>
        </div>
        <div class="col-8">
            <div class="my-2">
                <form class="d-flex justify-content-end gap-2" method="POST" action="{{ route('admin.book.search') }}">
                    @csrf
                    <select class="form-select" style="width: 25%" name="category_id">
                    </select>
                    <select class="form-select" style="width: 25%" name="status">
                        <option selected disabled>Trạng thái</option>
                        <option value="Công bố" {{ session('status') == 'Công bố' ? 'selected' : '' }}>Công bố</option>
                        <option value="Bản nháp" {{ session('status') == 'Bản nháp' ? 'selected' : '' }}>Bản nháp</option>
                    </select>
                    <div class="">
                        <input type="text" name="name" class="form-control" placeholder="Tên"
                            value="{{ session('name') }}">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h2>Danh sách bài đăng</h2>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-3">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">CODE</th>
                                    <th scope="col">Giảm giá</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hết hạn</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($coupons) > 0)
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($coupons as $data)
                                        <tr>
                                            <th>{{ $i }}</th>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->code }}</td>
                                            <td>{{ $data->discount }}{{ $data->getCouponValue() }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>{{ $data->end_time }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    {{-- Sửa --}}
                                                    <x-button.edit-btn :route="'admin.coupon.edit'" :id="$data->id" />
                                                    {{-- Xoá --}}
                                                    <x-button.force-del-btn :route="'admin.coupon.destroy'" :id="$data->id" />
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Không có dữ liệu
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- MẪU --}}
@section('title', 'Danh sách bài đăng')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">

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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

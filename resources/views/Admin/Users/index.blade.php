{{-- MẪU --}}
@section('title', 'Danh sách người dùng')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="col-6 my-2 float-end">
                <form class="d-flex justify-content-end gap-2" method="POST" action="{{ route('admin.user.search') }}">
                    @csrf
                    <select class="form-select" style="width: 25%" name="status">
                        <option selected disabled>Quyền hạn</option>
                        <option value="Công bố" {{ session('role') == '1' ? 'selected' : '' }}>Admin</option>
                        <option value="Bản nháp" {{ session('role') == '0' ? 'selected' : '' }}>Khách hàng</option>
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
            <h2>Danh sách người dùng</h2>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-3">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Quyền hạn</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Điểm mua hàng</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($User) > 0)
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($User as $data)
                                        <tr>
                                            <th>{{ $i }}</th>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                @if ($data->role == 0)
                                                    <button class="btn btn-primary" disabled>Khách hàng</button>
                                                @elseif ($data->role == 1)
                                                    <button class="btn btn-success" disabled>Quản trị</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->status == 1)
                                                    <button class="btn btn-success" disabled>Hoạt động</button>
                                                @elseif ($data->role == 1)
                                                    <button class="btn btn-danger" disabled>Bị khoá</button>
                                                @endif
                                            </td>
                                            <td>{{ $data->point }} điểm</td>
                                            <td>
                                                <div class="d-flex">
                                                    {{-- Sửa --}}
                                                    <x-button.edit-btn :route="'admin.user.edit'" :id="$data->id" />
                                                    {{-- Xoá --}}
                                                    <x-button.soft-del-btn :route="'admin.user.delete'" :id="$data->id" />
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
                        {{ $User->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

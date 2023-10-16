{{-- MẪU --}}
@include('Admin.Categories.Modal.create')
@include('Admin.Categories.Modal.view')
@section('title', 'Danh sách danh mục')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#create"><i class="bi bi-plus me-2"></i>Thêm mới</button>
                <a class="btn btn-outline-dark" href=""><i class="bi bi-trash me-2"></i>Thùng rác</a>
            </div>
        </div>
        <div class="col-6">
            <div class="my-2">
                {{-- <div class="alert alert-success" role="alert">
                    Thêm sửa xoá thành công...
                </div> --}}
            </div>
        </div>
    </div>
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h2>Table</h2>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $data)
                                    <tr>
                                        <th>{{ $data->id }}</th>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->slug }}</td>
                                        <td>{{ $data->limit() }}</td>
                                        <td>
                                            <!-- Nút View -->
                                            <button type="button" value="{{ $data->id }}"
                                                class="btn btn-outline-primary viewBtn">
                                                <i class="bi bi-eye me-2"></i>View
                                            </button>
                                            {{-- Sửa --}}
                                            <a class="btn btn-outline-warning" href=""><i
                                                    class="bi bi-pencil me-2"></i>Edit</a>
                                            {{-- Xoá --}}
                                            <a class="btn btn-outline-danger" href=""><i
                                                    class="bi bi-trash me-2"></i>Move to trash</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Create

        //  Show
        $(document).ready(function() {
            $(document).on('click', '.viewBtn', function() {
                var cate_id = $(this).val();
                $('#viewModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "category/show/" + cate_id,
                    success: function(response) {
                        // console.log(response)
                        $('#name').val(response.category.name);
                        $('#slug').val(response.category.slug);
                        $('#description').val(response.category.description);
                    }
                });
            });
        });
        // Edit
        $(document).ready(function () {
        });
    </script>
@endsection

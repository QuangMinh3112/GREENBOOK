{{-- MẪU --}}
@section('title', 'Data Table')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="my-2">
                <a class="btn btn-outline-dark" href=""><i class="bi bi-trash me-2"></i>Trash can</a>
            </div>
        </div>
        <div class="col-6">
            <div class="my-2">
                <div class="alert alert-success" role="alert">
                    Thêm sửa xoá thành công...
                </div>
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
                                    <th>#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>
                                        <!-- Nút View -->
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <i class="bi bi-eye me-2"></i>View
                                        </button>
                                        <!-- Bảng View -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Test View</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Sửa --}}
                                        <a class="btn btn-outline-warning" href=""><i
                                                class="bi bi-pencil me-2"></i>Edit</a>
                                        {{-- Xoá --}}
                                        <a class="btn btn-outline-danger" href=""><i
                                                class="bi bi-trash me-2"></i>Move to trash</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

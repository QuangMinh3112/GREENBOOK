{{-- MẪU --}}
@section('title', 'Data Table')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white"><h2>Table</h2></div>
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
                                        <a class="btn btn-outline-warning" href=""><i class="bi bi-pencil me-2"></i>Edit</a>
                                        <a class="btn btn-outline-danger" href=""><i class="bi bi-trash me-2"></i>Move to trash</a>
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

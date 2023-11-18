{{-- MẪU --}}
@section('title', 'Danh sách bài đăng')
@extends('Admin.Layouts.layout')
@section('content')
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <h2>Chi tiết bài đăng</h2>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="rounded-bottom">
                    <div class="p-4">
                        <div>
                            <h4 class="fs-1">{{ $post->title }}</h4>
                        </div>
                        <p style="font-size: 0.8rem">Ngày đăng:
                            {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</p>
                        <hr>
                        <div>
                            <img class="img-fluid rounded" src="{{ asset('storage/' . $post->image) }}" alt="">
                        </div>
                        <div class="mt-3 content">
                            {!! html_entity_decode($post->content) !!}
                        </div>
                    </div>
                    <div class="d-flex float-sm-end">
                        <x-button.previous-btn />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

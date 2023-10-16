{{-- MẪU --}}
@section('title', 'Form')
@extends('Admin.Layouts.layout')
@section('content')
<div class="col-8 mx-auto">
    <div class="card mb-4 shadow">
      <div class="card-header bg-dark text-white"><h2>Form</h2></div>
      <div class="card-body">
        <div class="example">
          <div class="rounded-bottom">
            <div class="p-3 active" id="preview-1000">
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input class="form-control" type="email">
              </div>
              <div class="mb-3">
                <label class="form-label">Example textarea</label>
                <textarea class="form-control" rows="5"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

<div class="card mb-4 shadow">
    <div class="card-header py-3 bg-green">
        <h6 class="m-0 font-weight-bold text-white">Chi tiết bài đăng</h6>
    </div>
    <div class="card-body">
        <h3 class="card-title">{{ $post->title }}</h3>
        <p class="card-text">Người đăng: {{ $post->getUserName() }}</p>
        <p class="card-text">Ngày đăng: {{ $post->created_at->format('d/m/Y H:i:s') }}</p>

        <div class="mx-auto">
            @if ($post->image)
                <img src="{{ $post->image }}" class="img-fluid rounded img-thumbnail mx-auto d-block" alt="Ảnh đính kèm">
            @endif
        </div>

        <p class="card-text mt-3">{{ $post->content }}</p>
    </div>
    <div class="card-footer ">
        <div class="float-right">
            <x-button.previous-btn></x-button.previous-btn>
        </div>
    </div>
</div>

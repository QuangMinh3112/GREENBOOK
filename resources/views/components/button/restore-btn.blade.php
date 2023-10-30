<div>
    @props(['route', 'id'])
    <a class="btn btn-outline-success" href="{{ route($route, ['id' => $id]) }}">
        <i class="fa-solid fa-arrow-rotate-left"></i>
    </a>
</div>

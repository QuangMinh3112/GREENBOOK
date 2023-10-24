<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    @props(['route', 'id'])
    <a class="btn btn-outline-warning" href="{{ route($route, ['id' => $id]) }}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
</div>

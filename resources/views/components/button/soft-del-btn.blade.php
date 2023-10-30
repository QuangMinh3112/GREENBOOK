<div>
    @props(['route', 'id'])
    <a onclick="confirmationSoft(event)" class="btn btn-outline-danger"
        href="{{ route($route, ['id' => $id]) }}">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>

<div>
    @props(['route', 'id'])
    <a onclick="confirmationForce(event)" class="btn btn-outline-danger" href="{{ route($route, ['id' => $id]) }}">
        <i class="fa-solid fa-circle-xmark"></i>
    </a>
</div>

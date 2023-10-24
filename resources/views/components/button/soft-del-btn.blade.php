<div>
    @props(['route', 'id'])
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    <a onclick="return confirm('Bạn có chắc không ?')" class="btn btn-outline-danger"
        href="{{ route($route, ['id' => $id]) }}">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>

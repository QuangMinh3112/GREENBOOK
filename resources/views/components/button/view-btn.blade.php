<div>
    @props(['id', 'route'])
    <!-- Well begun is half done. - Aristotle -->
    <a href="{{ route($route, ['id' => $id]) }}" class="btn btn-outline-primary">
        <i class="fa-solid fa-eye"></i>
    </a>
</div>

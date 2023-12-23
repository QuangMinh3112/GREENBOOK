@if ($paginator->hasPages())
    <ul class="pagination pagination-rounded">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><a href="javascript:;" wire:click="previousPage" class="page-link">Trước</a></li>
        @else
            <li class="page-item"><a href="javascript:;" wire:click="previousPage" rel="prev" class="page-link">Trước</a>
            </li>
        @endif

        {{-- Pagination Element Here --}}
        @foreach ($elements as $element)
            {{-- Make dots here --}}
            @if (is_string($element))
                <li class="page-item disabled"><a class="page-link"><span>{{ $element }}</span></a></li>
            @endif

            {{-- Links array Here --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><a href="javascript:;"
                                wire:click="gotoPage({{ $page }})"
                                class="page-link"><span>{{ $page }}</span></a></li>
                    @else
                        <li class="page-item"><a href="javascript:;" wire:click="gotoPage({{ $page }})"
                                class="page-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a href="javascript:;" wire:click="nextPage" class="page-link">Tiếp</a></li>
        @else
            <li class="page-item disabled"><a href="javascript:;" class="page-link">Tiếp</a></li>
        @endif
    </ul>
@endif
